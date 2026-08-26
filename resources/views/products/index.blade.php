@extends('layouts.app')

@section('content')

<style>
    .products-page {
        min-height: calc(100vh - 70px);
        background: #f5f7fb;
        padding: 35px 45px;
    }

    .products-container {
        max-width: 1250px;
        margin: 0 auto;
    }

    /* HEADER */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .page-title {
        margin: 0;
        font-size: 30px;
        font-weight: 700;
        color: #172554;
    }

    .page-subtitle {
        margin-top: 8px;
        color: #64748b;
        font-size: 15px;
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* SEARCH */
    .search-box {
        width: 285px;
        height: 46px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: white;
        padding: 0 15px;
        font-size: 14px;
        outline: none;
    }

    .search-box:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .1);
    }

    .add-button {
        height: 46px;
        padding: 0 20px;
        border: none;
        border-radius: 9px;
        background: #4f46e5;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .add-button:hover {
        background: #4338ca;
    }

    /* TABLE CARD */
    .table-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .05);
    }

    .table-header {
        height: 72px;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-title {
        font-size: 19px;
        font-weight: 700;
        color: #172554;
    }

    .product-count {
        color: #64748b;
        font-size: 14px;
    }

    /* TABLE */
    .product-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .product-table th,
    .product-table td {
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
        white-space: nowrap;
    }

    .product-table th {
        height: 58px;
        background: #f8fafc;
        color: #334155;
        font-size: 14px;
        font-weight: 600;
        text-align: left;
    }

    .product-table td {
        height: 72px;
        color: #0f172a;
        font-size: 14px;
    }

    .product-table tbody tr:hover {
        background: #fafbff;
    }

    /* UKURAN KOLOM TABEL */
.col-no {
    width: 7%;
    text-align: center !important;
}

.col-sku {
    width: 13%;
}

.col-name {
    width: 23%;
}

.col-category {
    width: 20%;
}

.col-price {
    width: 13%;
    text-align: left !important;
}

.col-stock {
    width: 9%;
    text-align: left !important;
}

.col-action {
    width: 15%;
    text-align: center !important;
}

    /* ISI */
    .sku-badge {
        display: inline-block;
        background: #eef2ff;
        color: #4338ca;
        padding: 7px 10px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
    }

    .product-name {
        font-weight: 600;
        color: #0f172a;
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 13px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .category-food {
        background: #fff7ed;
        color: #c2410c;
    }

    .category-drink {
        background: #eff6ff;
        color: #2563eb;
    }

    .price {
        font-weight: 600;
    }

    .stock {
        font-weight: 600;
    }

    /* KOLOM AKSI */
.col-action {
    width: 15%;
    text-align: center !important;
}

/* TOMBOL AKSI */
.action-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    width: 100%;
    padding-right: 15px;
    box-sizing: border-box;
}

.edit-button,
.delete-button {
    height: 38px;
    padding: 0 13px;
    border-radius: 7px;
    border: none;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
}

.edit-button {
    background: #facc15;
    color: #422006;
}

.edit-button:hover {
    background: #eab308;
}

.delete-button {
    background: #ef4444;
    color: white;
}

.delete-button:hover {
    background: #dc2626;
}

    /* EMPTY */
    .empty-data {
        text-align: center;
        padding: 45px !important;
        color: #94a3b8;
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {

        .products-page {
            padding: 25px 15px;
        }

        .page-header {
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
        }

        .header-right {
            width: 100%;
        }

        .search-box {
            width: 100%;
        }

        .add-button {
            flex-shrink: 0;
        }

        .table-card {
            overflow-x: auto;
        }

        .product-table {
            min-width: 950px;
        }
    }
</style>


<div class="products-page">

    <div class="products-container">

        {{-- HEADER --}}
        <div class="page-header">

            <div>
                <h1 class="page-title">
                    Data Produk
                </h1>

                <div class="page-subtitle">
                    Kelola data produk, stok, harga, dan kategori produk.
                </div>
            </div>

            <div class="header-right">

                <form action="{{ route('products.index') }}" method="GET">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari nama produk atau SKU..."
                        class="search-box"
                    >

                </form>

                <a
                    href="{{ route('products.create') }}"
                    class="add-button"
                >
                    + Tambah Produk
                </a>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="table-card">

            <div class="table-header">

                <div class="table-title">
                    Daftar Produk
                </div>

                <div class="product-count">
                    {{ $products->count() }} produk
                </div>

            </div>


            <table class="product-table">

                {{-- KOLOM --}}
                <colgroup>
                    <col class="col-no">
                    <col class="col-sku">
                    <col class="col-name">
                    <col class="col-category">
                    <col class="col-price">
                    <col class="col-stock">
                    <col class="col-action">
                </colgroup>


                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th class="col-price">Harga</th>
                        <th class="col-stock">Stok</th>
                        <th class="col-action">Aksi</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($products as $product)

                    <tr>

                        <td class="col-no">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <span class="sku-badge">
                                {{ $product->sku }}
                            </span>
                        </td>

                        <td>
                            <span class="product-name">
                                {{ $product->name }}
                            </span>
                        </td>

                        <td>
                            @if(($product->category->name ?? '') === 'Makanan')

                                <span class="category-badge category-food">
                                    🍔 {{ $product->category->name }}
                                </span>

                            @else

                                <span class="category-badge category-drink">
                                    🥤 {{ $product->category->name ?? '-' }}
                                </span>

                            @endif
                        </td>

                        <td class="col-price">
                            <span class="price">
                                Rp {{ number_format($product->sell_price, 0, ',', '.') }}
                            </span>
                        </td>

                        <td class="col-stock">
                            <span class="stock">
                                {{ $product->stock }}
                            </span>
                        </td>

                        <td class="col-action">

                            <div class="action-buttons">

                                <a
                                    href="{{ route('products.edit', $product->id) }}"
                                    class="edit-button"
                                >
                                    ✏️ Edit
                                </a>

                                <form
                                    action="{{ route('products.destroy', $product->id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-button"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                    >
                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="empty-data">
                            Belum ada data produk.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection