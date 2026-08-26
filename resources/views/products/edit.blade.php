@extends('layouts.app')

@section('content')

<style>
    /* ===== HALAMAN EDIT PRODUK ===== */

    .edit-page {
        min-height: calc(100vh - 70px);
        background: #f5f7fb;
        padding: 35px 30px;
    }

    .edit-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Judul */
    .edit-header {
        margin-bottom: 25px;
    }

    .edit-header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #172554;
    }

    .edit-header p {
        margin-top: 8px;
        margin-bottom: 0;
        color: #64748b;
        font-size: 15px;
    }

    /* Card */
    .edit-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.06);
        padding: 30px;
    }

    .edit-card-title {
        font-size: 20px;
        font-weight: 700;
        color: #172554;
        margin-bottom: 28px;
    }

    /* Form */
    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    .form-control {
        width: 100%;
        height: 46px;
        padding: 0 14px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #fff;
        color: #1e293b;
        font-size: 14px;
        box-sizing: border-box;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.10);
    }

    select.form-control {
        cursor: pointer;
    }

    /* Error */
    .error-message {
        margin-top: 6px;
        font-size: 13px;
        color: #dc2626;
    }

    /* Tombol */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #e2e8f0;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 105px;
        height: 44px;
        padding: 0 20px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .btn-update {
        background: #4f46e5;
        color: white;
    }

    .btn-update:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
    }

    .btn-back {
        background: #e2e8f0;
        color: #334155;
    }

    .btn-back:hover {
        background: #cbd5e1;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-page {
            padding: 25px 15px;
        }

        .edit-card {
            padding: 22px;
        }

        .edit-header h1 {
            font-size: 24px;
        }

        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .btn {
            width: 100%;
        }
    }
</style>


<div class="edit-page">

    <div class="edit-container">

        <!-- Header -->
        <div class="edit-header">
            <h1>Edit Produk</h1>
            <p>Ubah informasi produk seperti kategori, SKU, harga, dan stok.</p>
        </div>


        <!-- Form Card -->
        <div class="edit-card">

            <div class="edit-card-title">
                Informasi Produk
            </div>

            <form action="{{ route('products.update', $product->id) }}" method="POST">

                @csrf
                @method('PUT')


                <!-- Kategori -->
                <div class="form-group">

                    <label for="category_id">
                        Kategori
                    </label>

                    <select
                        name="category_id"
                        id="category_id"
                        class="form-control"
                        required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('category_id')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- SKU -->
                <div class="form-group">

                    <label for="sku">
                        SKU
                    </label>

                    <input
                        type="text"
                        name="sku"
                        id="sku"
                        value="{{ old('sku', $product->sku) }}"
                        class="form-control"
                        placeholder="Masukkan SKU produk"
                        required>

                    @error('sku')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- Nama Produk -->
                <div class="form-group">

                    <label for="name">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $product->name) }}"
                        class="form-control"
                        placeholder="Masukkan nama produk"
                        required>

                    @error('name')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- Harga -->
                <div class="form-group">

                    <label for="sell_price">
                        Harga Jual
                    </label>

                    <input
                        type="number"
                        name="sell_price"
                        id="sell_price"
                        value="{{ old('sell_price', $product->sell_price) }}"
                        class="form-control"
                        placeholder="Masukkan harga jual"
                        min="0"
                        required>

                    @error('sell_price')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- Stok -->
                <div class="form-group">

                    <label for="stock">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stock"
                        id="stock"
                        value="{{ old('stock', $product->stock) }}"
                        class="form-control"
                        placeholder="Masukkan jumlah stok"
                        min="0"
                        required>

                    @error('stock')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- Tombol -->
                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-update">
                        ✓ Update
                    </button>

                    <a
                        href="{{ route('products.index') }}"
                        class="btn btn-back">
                        ← Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection