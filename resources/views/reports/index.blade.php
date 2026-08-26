@extends('layouts.app')

@section('content')

<style>
    .report-page {
        padding: 30px;
        background: #f5f7fb;
        min-height: calc(100vh - 70px);
    }

    .report-header {
        margin-bottom: 25px;
    }

    .report-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 6px;
    }

    .report-header p {
        color: #6b7280;
        margin: 0;
        font-size: 14px;
    }

    /* FILTER */
    .filter-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        margin-bottom: 22px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .filter-title {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 16px;
    }

    .filter-form {
        display: grid;
        grid-template-columns: 1fr 1fr auto auto;
        gap: 15px;
        align-items: end;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 7px;
    }

    .form-group input {
        width: 100%;
        padding: 11px 13px;
        border: 1px solid #d1d5db;
        border-radius: 9px;
        font-size: 14px;
        box-sizing: border-box;
        outline: none;
        transition: 0.2s;
    }

    .form-group input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .btn-filter {
        border: none;
        padding: 11px 20px;
        border-radius: 9px;
        background: #4f46e5;
        color: white;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-filter:hover {
        background: #4338ca;
    }

    .btn-reset {
        padding: 10px 18px;
        border-radius: 9px;
        border: 1px solid #d1d5db;
        background: white;
        color: #4b5563;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-reset:hover {
        background: #f9fafb;
    }

    /* SUMMARY */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    margin-bottom: 22px;
}

.summary-card {
    border-radius: 16px;
    padding: 24px;
    border: none;
    min-height: 135px;
    box-sizing: border-box;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
    transition: all 0.25s ease;
    position: relative;
    overflow: hidden;
}

/* Efek saat mouse diarahkan ke card */
.summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
}

/* Lingkaran dekorasi */
.summary-card::after {
    content: "";
    position: absolute;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.12);
    right: -25px;
    bottom: -35px;
}

/* CARD PERTAMA - UNGU */
.summary-card:nth-child(1) {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
}

/* CARD KEDUA - BIRU */
.summary-card:nth-child(2) {
    background: linear-gradient(135deg, #0284c7, #06b6d4);
}

/* CARD KETIGA - HIJAU */
.summary-card:nth-child(3) {
    background: linear-gradient(135deg, #059669, #10b981);
}

/* Judul card */
.summary-label {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 10px;
    position: relative;
    z-index: 2;
}

/* Angka */
.summary-value {
    font-size: 28px;
    font-weight: 700;
    color: #ffffff;
    position: relative;
    z-index: 2;
}

/* Keterangan */
.summary-description {
    margin-top: 8px;
    font-size: 12px;
    color: rgba(255, 255, 255, 0.75);
    position: relative;
    z-index: 2;
}

    /* CHART */
    .chart-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        margin-bottom: 22px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .section-title {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .section-description {
        font-size: 12px;
        color: #9ca3af;
        margin-bottom: 20px;
    }

    .chart-wrapper {
        position: relative;
        height: 330px;
    }

    /* TABLE */
    .table-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .table-container {
        overflow-x: auto;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 18px;
    }

    .report-table th {
        background: #f9fafb;
        color: #6b7280;
        font-size: 12px;
        font-weight: 600;
        text-align: left;
        padding: 13px 14px;
        border-bottom: 1px solid #e5e7eb;
    }

    .report-table td {
        padding: 14px;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #f1f1f1;
    }

    .report-table tbody tr:hover {
        background: #fafafa;
    }

    .invoice {
        font-weight: 600;
        color: #4f46e5;
    }

    .amount {
        font-weight: 600;
        color: #111827;
    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background: #dcfce7;
        color: #15803d;
        font-size: 11px;
        font-weight: 600;
    }

    .empty-data {
        text-align: center;
        padding: 35px !important;
        color: #9ca3af !important;
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
        .filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .report-page {
            padding: 18px;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .chart-wrapper {
            height: 250px;
        }
    }
</style>


<div class="report-page">

    {{-- HEADER --}}
    <div class="report-header">
        <h1>Laporan Penjualan</h1>
        <p>Kelola dan pantau data penjualan berdasarkan rentang tanggal.</p>
    </div>


    {{-- FILTER --}}
    <div class="filter-card">

        <div class="filter-title">
            Filter Laporan
        </div>

        <form method="GET" action="{{ route('reports.index') }}">

            <div class="filter-form">

                <div class="form-group">
                    <label for="from">Dari Tanggal</label>

                    <input
                        type="date"
                        name="from"
                        value="{{ $from ?? now()->format('Y-m-d') }}"
                    >
                </div>


                <div class="form-group">
                    <label for="to">Sampai Tanggal</label>

                        <input
                            type="date"
                            name="to"
                            value="{{ $to ?? now()->format('Y-m-d') }}"
                        >
                </div>


                <button type="submit" class="btn-filter">
                    Filter
                </button>


                <a href="{{ route('reports.index') }}" class="btn-reset">
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- SUMMARY --}}
    <div class="summary-grid">

        <div class="summary-card">
            <div class="summary-label">
                Total Transaksi
            </div>

            <div class="summary-value">
                {{ $transactions->count() }}
            </div>

            <div class="summary-description">
                Transaksi pada periode yang dipilih
            </div>
        </div>


        <div class="summary-card">
            <div class="summary-label">
                Total Penjualan
            </div>

            <div class="summary-value">
                Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}
            </div>

            <div class="summary-description">
                Total transaksi completed
            </div>
        </div>


        <div class="summary-card">
            <div class="summary-label">
                Transaksi Completed
            </div>

            <div class="summary-value">
                {{ $transactions->where('status', 'completed')->count() }}
            </div>

            <div class="summary-description">
                Transaksi berhasil
            </div>
        </div>

    </div>


    {{-- CHART --}}
    <div class="chart-card">

        <div class="section-title">
            Grafik Penjualan Harian
        </div>

        <div class="section-description">
            Tren total penjualan berdasarkan tanggal.
        </div>

        <div class="chart-wrapper">
            <canvas id="salesChart"></canvas>
        </div>

    </div>


    {{-- TABLE --}}
    <div class="table-card">

        <div class="section-title">
            Data Penjualan
        </div>

        <div class="section-description">
            Daftar transaksi yang berhasil pada periode yang dipilih.
        </div>

        <div class="table-container">

            <table class="report-table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Invoice</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($transactions as $transaction)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $transaction->created_at->format('d-m-Y H:i') }}
                            </td>

                            <td>
                                <span class="invoice">
                                    {{ $transaction->invoice_number }}
                                </span>
                            </td>

                            <td>
                                <span class="amount">
                                    Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                <span class="status">
                                    Completed
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="empty-data">
                                Tidak ada transaksi pada periode ini.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const labels = @json($dailySales->keys());
    const salesData = @json($dailySales->values());

    const ctx = document.getElementById('salesChart');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [{
                label: 'Penjualan',
                data: salesData,

                borderWidth: 3,

                tension: 0.4,

                fill: true,

                pointRadius: 5,

                pointHoverRadius: 7
            }]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {

                legend: {
                    display: false
                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return ' Rp ' +
                                new Intl.NumberFormat('id-ID').format(
                                    context.raw
                                );

                        }

                    }

                }

            },

            scales: {

                x: {
                    grid: {
                        display: false
                    },

                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        callback: function(value) {

                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID').format(value);

                        }

                    }

                }

            }

        }

    });

</script>

@endsection