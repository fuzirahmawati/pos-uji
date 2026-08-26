<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;

class DashboardController extends Controller
{
    public function index()
    {
        $todaySales = Transaction::whereDate('created_at', today())
            ->where('status', 'completed')
            ->sum('total_amount');

        $todayTransactions = Transaction::whereDate('created_at', today())
            ->where('status', 'completed')
            ->count();

        $topProducts = TransactionItem::select('product_id')
            ->selectRaw('SUM(quantity) as total_qty')
            ->whereMonth('created_at', now()->month)
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'todaySales',
            'todayTransactions',
            'topProducts'
        ));
    }
}