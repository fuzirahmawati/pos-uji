<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $transactions = Transaction::where('status', 'completed')
            ->when($from && $to, function ($query) use ($from, $to) {
                $query->whereBetween('created_at', [
                    $from . ' 00:00:00',
                    $to . ' 23:59:59',
                ]);
            })
            ->latest()
            ->get();

        // Data untuk grafik penjualan harian
        $dailySales = $transactions
            ->groupBy(function ($transaction) {
                return $transaction->created_at->format('Y-m-d');
            })
            ->map(function ($transactions) {
                return $transactions->sum('total_amount');
            });

        return view('reports.index', compact(
            'transactions',
            'from',
            'to',
            'dailySales'
        ));
    }
}