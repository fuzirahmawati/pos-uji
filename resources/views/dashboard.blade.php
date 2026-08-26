@extends('layouts.app')

@section('content')

<style>
    /* ==============================
       DASHBOARD
    ============================== */

    .dashboard-page {
        padding: 30px;
        background: #f3f6fb;
        min-height: calc(100vh - 70px);
    }

    /* HEADER */
    .dashboard-header {
        margin-bottom: 25px;
    }

    .dashboard-title {
        font-size: 28px;
        font-weight: 800;
        color: #172033;
        margin: 0;
    }

    .dashboard-subtitle {
        color: #7b8496;
        font-size: 14px;
        margin-top: 6px;
    }


    /* ==============================
       SUMMARY CARDS
    ============================== */

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }

    .dashboard-card {
        position: relative;
        overflow: hidden;
        min-height: 145px;
        padding: 23px;
        border-radius: 18px;
        color: white;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .dashboard-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        right: -30px;
        bottom: -35px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
    }

    .dashboard-card::before {
        content: "";
        position: absolute;
        width: 55px;
        height: 55px;
        right: 35px;
        top: -20px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .card-blue {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
    }

    .card-green {
        background: linear-gradient(135deg, #059669, #10b981);
    }

    .card-orange {
        background: linear-gradient(135deg, #ea580c, #f97316);
    }

    .card-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .card-label {
        font-size: 13px;
        font-weight: 500;
        opacity: 0.9;
    }

    .card-value {
        font-size: 27px;
        font-weight: 800;
        margin-top: 5px;
    }

    .card-description {
        font-size: 11px;
        opacity: 0.8;
        margin-top: 6px;
    }


    /* ==============================
       PRODUK TERLARIS
    ============================== */

    .dashboard-section {
        background: white;
        border-radius: 18px;
        padding: 23px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #e8ebf1;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 750;
        color: #172033;
        margin: 0;
    }

    .section-subtitle {
        color: #9aa2b1;
        font-size: 12px;
        margin-top: 4px;
    }

    .section-badge {
        background: #eef2ff;
        color: #4f46e5;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }


    /* ==============================
       PRODUCT GRID
    ============================== */

    .product-list {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
    }

    .product-card {
        position: relative;
        background: #f8faff;
        border: 1px solid #e5e9f2;
        border-radius: 14px;
        padding: 18px 14px;
        text-align: center;
        transition: 0.2s ease;
    }

    .product-card:hover {
        transform: translateY(-3px);
        border-color: #a5b4fc;
        box-shadow: 0 7px 16px rgba(79, 70, 229, 0.10);
    }

    .product-rank {
        position: absolute;
        top: 9px;
        left: 9px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #4f46e5;
        color: white;
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-icon {
        width: 50px;
        height: 50px;
        margin: 4px auto 10px;
        border-radius: 14px;
        background: #eef2ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .product-name {
        font-weight: 700;
        color: #273142;
        font-size: 13px;
        min-height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-qty {
        display: inline-block;
        margin-top: 9px;
        padding: 5px 9px;
        border-radius: 20px;
        background: #e0e7ff;
        color: #4338ca;
        font-size: 11px;
        font-weight: 700;
    }


    /* ==============================
       EMPTY DATA
    ============================== */

    .empty-product {
        grid-column: 1 / -1;
        text-align: center;
        padding: 45px 20px;
        border: 1px dashed #d5dae4;
        border-radius: 14px;
        background: #fafbfc;
    }

    .empty-icon {
        font-size: 38px;
        margin-bottom: 10px;
    }

    .empty-title {
        color: #4b5563;
        font-size: 14px;
        font-weight: 600;
    }

    .empty-description {
        color: #9ca3af;
        font-size: 12px;
        margin-top: 4px;
    }


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 1000px) {

        .dashboard-cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .product-list {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 700px) {

        .dashboard-page {
            padding: 18px;
        }

        .dashboard-cards {
            grid-template-columns: 1fr;
        }

        .product-list {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 450px) {

        .product-list {
            grid-template-columns: 1fr;
        }
    }

</style>


<div class="dashboard-page">


    {{-- =========================
         HEADER
    ========================== --}}

    <div class="dashboard-header">

        <h1 class="dashboard-title">
            Dashboard
        </h1>

        <p class="dashboard-subtitle">
            Ringkasan penjualan hari ini
        </p>

    </div>


    {{-- =========================
         SUMMARY CARDS
    ========================== --}}

    <div class="dashboard-cards">


        {{-- TOTAL PENJUALAN --}}

        <div class="dashboard-card card-blue">

            <div class="card-icon">
                💰
            </div>

            <div class="card-label">
                Total Penjualan Hari Ini
            </div>

            <div class="card-value">
                Rp {{ number_format($todaySales, 0, ',', '.') }}
            </div>

            <div class="card-description">
                Total transaksi yang berhasil
            </div>

        </div>


        {{-- TOTAL TRANSAKSI --}}

        <div class="dashboard-card card-green">

            <div class="card-icon">
                🛒
            </div>

            <div class="card-label">
                Jumlah Transaksi Hari Ini
            </div>

            <div class="card-value">
                {{ $todayTransactions }}
            </div>

            <div class="card-description">
                Transaksi berhasil hari ini
            </div>

        </div>


        {{-- PRODUK TERLARIS --}}

        <div class="dashboard-card card-orange">

            <div class="card-icon">
                🏆
            </div>

            <div class="card-label">
                Produk Terlaris
            </div>

            <div class="card-value">
                {{ $topProducts->count() }}
            </div>

            <div class="card-description">
                Produk terlaris bulan ini
            </div>

        </div>

    </div>



    {{-- =========================
         PRODUK TERLARIS
    ========================== --}}

    <div class="dashboard-section">


        <div class="section-header">

            <div>

                <h2 class="section-title">
                    🏆 5 Produk Terlaris Bulan Ini
                </h2>

                <p class="section-subtitle">
                    Produk dengan jumlah penjualan terbanyak
                </p>

            </div>

            <div class="section-badge">
                Bulan Ini
            </div>

        </div>



        <div class="product-list">


            @forelse ($topProducts as $index => $item)


                <div class="product-card">


                    {{-- NOMOR URUT --}}

                    <div class="product-rank">
                        {{ $index + 1 }}
                    </div>


                    {{-- ICON --}}

                    <div class="product-icon">
                        🛍️
                    </div>


                    {{-- NAMA PRODUK --}}

                    <div class="product-name">

                        {{ $item->product->name ?? 'Produk' }}

                    </div>


                    {{-- JUMLAH TERJUAL --}}

                    <div class="product-qty">

                        {{ $item->total_qty }} terjual

                    </div>


                </div>


            @empty


                <div class="empty-product">

                    <div class="empty-icon">
                        📦
                    </div>

                    <div class="empty-title">
                        Belum ada data penjualan
                    </div>

                    <div class="empty-description">
                        Belum ada produk yang terjual bulan ini.
                    </div>

                </div>


            @endforelse


        </div>

    </div>


</div>

@endsection