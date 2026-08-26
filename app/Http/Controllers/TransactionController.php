<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->get();

        $categories = Category::all();

        return view('transactions.index', compact(
            'products',
            'categories'
        ));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('items.product');

        return view('transactions.show', compact('transaction'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],

            'items.*.product_id' => [
                'required',
                'integer',
                'exists:products,id'
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1'
            ],

            'paid_amount' => [
                'required',
                'numeric',
                'min:0'
            ],
        ]);

        try {

            $transaction = DB::transaction(function () use ($validated) {

                // Hitung total
                $total = 0;

                foreach ($validated['items'] as $item) {
                    $product = Product::findOrFail($item['product_id']);

                    $total += $product->sell_price * $item['quantity'];
                }

                // Cek pembayaran
                if ($validated['paid_amount'] < $total) {
                    throw new \Exception(
                        'Uang pembayaran kurang dari total transaksi.'
                    );
                }

                // Buat transaksi
                $transaction = Transaction::create([
                    'invoice_number' => 'INV-' . now()->format('YmdHis') . '-' . rand(100, 999),
                    'user_id' => auth()->id(),
                    'customer_id' => null,
                    'total_amount' => $total,
                    'paid_amount' => $validated['paid_amount'],
                    'change_amount' => $validated['paid_amount'] - $total,
                    'payment_method' => 'cash',
                    'status' => 'completed',
                ]);

                // Proses setiap produk
                foreach ($validated['items'] as $item) {

                    // Kunci produk supaya stok aman
                    $product = Product::lockForUpdate()
                        ->findOrFail($item['product_id']);

                    // Cek stok
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception(
                            "Stok {$product->name} tidak mencukupi. Stok tersedia hanya {$product->stock}."
                        );
                    }

                    // Simpan transaction item
                    $transaction->items()->create([
                        'product_id' => $product->id,
                        'price' => $product->sell_price,
                        'quantity' => $item['quantity'],
                        'subtotal' => $product->sell_price * $item['quantity'],
                    ]);

                    // Simpan stock movement
                    $product->stockMovements()->create([
                        'type' => 'out',
                        'quantity' => $item['quantity'],
                        'reference_type' => Transaction::class,
                        'reference_id' => $transaction->id,
                    ]);

                    // Kurangi stok
                    $product->decrement(
                        'stock',
                        $item['quantity']
                    );
                }

                return $transaction;
            });

            return redirect()
                ->route('transactions.show', $transaction)
                ->with('success', 'Transaksi berhasil disimpan.');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}