@extends('layouts.app')

@section('content')

<style>
    .receipt-page {
        min-height: calc(100vh - 70px);
        background: #f3f6fb;
        padding: 35px 20px;
    }

    .receipt-wrapper {
        max-width: 720px;
        margin: auto;
    }

    .receipt-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(31, 41, 55, 0.10);
        border: 1px solid #e5e7eb;
    }

    /* HEADER */
    .receipt-header {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: white;
        text-align: center;
        padding: 30px 25px;
    }

    .receipt-logo {
        width: 55px;
        height: 55px;
        margin: 0 auto 12px;
        border-radius: 15px;
        background: rgba(255,255,255,.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    .receipt-header h1 {
        margin: 0;
        font-size: 24px;
        font-weight: 800;
    }

    .receipt-header p {
        margin: 6px 0 0;
        font-size: 13px;
        opacity: .85;
    }

    /* BODY */
    .receipt-body {
        padding: 28px;
    }

    .invoice-info {
        text-align: center;
        margin-bottom: 25px;
    }

    .invoice-label {
        font-size: 12px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .invoice-number {
        font-size: 19px;
        font-weight: 800;
        color: #1f2937;
    }

    .invoice-date {
        font-size: 13px;
        color: #6b7280;
        margin-top: 5px;
    }

    /* PRODUK */
    .items-title {
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 12px;
    }

    .receipt-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px dashed #d1d5db;
    }

    .item-name {
        font-size: 15px;
        font-weight: 700;
        color: #1f2937;
    }

    .item-detail {
        font-size: 12px;
        color: #9ca3af;
        margin-top: 4px;
    }

    .item-total {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
        text-align: right;
    }

    /* TOTAL */
    .receipt-summary {
        margin-top: 20px;
        padding: 18px;
        background: #f8faff;
        border-radius: 14px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
        color: #6b7280;
    }

    .summary-row strong {
        color: #1f2937;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
    }

    .summary-total span:first-child {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
    }

    .summary-total span:last-child {
        font-size: 23px;
        font-weight: 800;
        color: #4f46e5;
    }

    .change {
        color: #059669 !important;
        font-weight: 700;
    }

    /* THANK YOU */
    .thank-you {
        text-align: center;
        margin-top: 25px;
        padding: 18px;
        border-radius: 14px;
        background: #ecfdf5;
        color: #047857;
    }

    .thank-you-icon {
        font-size: 25px;
        margin-bottom: 5px;
    }

    .thank-you strong {
        display: block;
        font-size: 14px;
    }

    .thank-you span {
        font-size: 12px;
        color: #6b7280;
    }

    /* BUTTON */
    .receipt-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-print,
    .btn-back {
        border: none;
        border-radius: 11px;
        padding: 13px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .btn-print {
        background: #4f46e5;
        color: white;
    }

    .btn-print:hover {
        background: #4338ca;
    }

    .btn-back {
        background: #eef2f7;
        color: #374151;
    }

    .btn-back:hover {
        background: #e5e7eb;
    }

    @media (max-width: 600px) {

        .receipt-page {
            padding: 20px 12px;
        }

        .receipt-body {
            padding: 20px;
        }

        .receipt-actions {
            grid-template-columns: 1fr;
        }
    }

    /* PRINT */
    @media print {

        body {
            background: white !important;
        }

        .receipt-page {
            padding: 0;
            background: white;
        }

        .receipt-card {
            box-shadow: none;
            border: none;
        }

        .receipt-actions {
            display: none;
        }

        .receipt-header {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

    }
</style>


<div class="receipt-page">

    <div class="receipt-wrapper">

        <div class="receipt-card">

            {{-- HEADER --}}
            <div class="receipt-header">

                <div class="receipt-logo">
                    🧾
                </div>

                <h1>STRUK TRANSAKSI</h1>

                <p>Point of Sale</p>

            </div>


            <div class="receipt-body">

                {{-- INFORMASI INVOICE --}}
                <div class="invoice-info">

                    <div class="invoice-label">
                        Nomor Invoice
                    </div>

                    <div class="invoice-number">
                        {{ $transaction->invoice_number }}
                    </div>

                    <div class="invoice-date">
                        {{ $transaction->created_at->format('d/m/Y H:i') }}
                    </div>

                </div>


                {{-- PRODUK --}}
                <div class="items-title">
                    Detail Produk
                </div>


                @foreach ($transaction->items as $item)

                    <div class="receipt-item">

                        <div>

                            <div class="item-name">
                                {{ $item->product->name ?? 'Produk' }}
                            </div>

                            <div class="item-detail">
                                {{ $item->quantity }}
                                ×
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </div>

                        </div>

                        <div class="item-total">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>

                    </div>

                @endforeach


                {{-- RINGKASAN --}}
                <div class="receipt-summary">

                    <div class="summary-row">

                        <span>
                            Subtotal
                        </span>

                        <strong>
                            Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="summary-row">

                        <span>
                            Dibayar
                        </span>

                        <strong>
                            Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="summary-total">

                        <span>
                            Total
                        </span>

                        <span>
                            Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                        </span>

                    </div>


                    <div class="summary-row" style="margin-top: 15px; margin-bottom: 0;">

                        <span>
                            Kembalian
                        </span>

                        <strong class="change">
                            Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}
                        </strong>

                    </div>

                </div>


                {{-- TERIMA KASIH --}}
                <div class="thank-you">

                    <div class="thank-you-icon">
                        ✓
                    </div>

                    <strong>
                        Transaksi berhasil
                    </strong>

                    <span>
                        Terima kasih telah berbelanja!
                    </span>

                </div>


                {{-- BUTTON --}}
                <div class="receipt-actions">

                    <button
                        onclick="window.print()"
                        class="btn-print"
                    >
                        🖨️ Cetak Struk
                    </button>


                    <a
                        href="{{ route('transactions.index') }}"
                        class="btn-back"
                    >
                        ← Kembali ke Transaksi
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection