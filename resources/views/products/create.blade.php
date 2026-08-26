@extends('layouts.app')

@section('content')

<style>
    /* ================================
       HALAMAN TAMBAH PRODUK
    ================================= */

    .create-page {
        min-height: calc(100vh - 70px);
        background: #f5f7fb;
        padding: 35px 45px;
    }

    .create-container {
        max-width: 900px;
        margin: 0 auto;
    }

    /* HEADER */

    .create-header {
        margin-bottom: 25px;
    }

    .create-title {
        margin: 0;
        font-size: 30px;
        font-weight: 700;
        color: #172554;
    }

    .create-subtitle {
        margin-top: 8px;
        color: #64748b;
        font-size: 15px;
    }

    /* CARD */

    .form-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 8px 25px rgba(15, 23, 42, .06);
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 22px;
        margin-bottom: 25px;
        border-bottom: 1px solid #e5e7eb;
    }

    .form-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #eef2ff;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .form-heading {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #172554;
    }

    .form-description {
        margin-top: 4px;
        color: #64748b;
        font-size: 13px;
    }

    /* FORM */

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    .required {
        color: #ef4444;
    }

    .form-input,
    .form-select {
        width: 100%;
        height: 46px;
        box-sizing: border-box;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        background: white;
        padding: 0 14px;
        font-size: 14px;
        color: #0f172a;
        outline: none;
        transition: .2s;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .10);
    }

    .form-input::placeholder {
        color: #94a3b8;
    }

    /* GRID */

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* INPUT ICON */

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
    }

    .input-with-icon {
        padding-left: 42px;
    }

    /* BUTTON */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        padding-top: 10px;
        margin-top: 10px;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        height: 44px;
        padding: 0 20px;
        border-radius: 8px;
        border: none;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: .2s;
    }

    .btn-save {
        background: #4f46e5;
        color: white;
        min-width: 110px;
    }

    .btn-save:hover {
        background: #4338ca;
        transform: translateY(-1px);
    }

    .btn-back {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .btn-back:hover {
        background: #e2e8f0;
    }

    /* ERROR */

    .error-message {
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    /* RESPONSIVE */

    @media (max-width: 700px) {

        .create-page {
            padding: 25px 15px;
        }

        .form-card {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .create-title {
            font-size: 25px;
        }

        .form-actions {
            justify-content: stretch;
        }

        .btn {
            flex: 1;
        }
    }
</style>


<div class="create-page">

    <div class="create-container">

        {{-- HEADER --}}
        <div class="create-header">

            <h1 class="create-title">
                Tambah Produk
            </h1>

            <div class="create-subtitle">
                Tambahkan produk baru ke dalam daftar produk.
            </div>

        </div>


        {{-- FORM CARD --}}
        <div class="form-card">

            {{-- CARD HEADER --}}
            <div class="form-card-header">

                <div class="form-icon">
                    🛍️
                </div>

                <div>
                    <h2 class="form-heading">
                        Informasi Produk
                    </h2>

                    <div class="form-description">
                        Isi informasi produk dengan lengkap dan benar.
                    </div>
                </div>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('products.store') }}"
                method="POST"
            >

                @csrf


                {{-- KATEGORI --}}
                <div class="form-group">

                    <label class="form-label">
                        Kategori <span class="required">*</span>
                    </label>

                    <select
                        name="category_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
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


                {{-- SKU & NAMA --}}
                <div class="form-row">

                    <div class="form-group">

                        <label class="form-label">
                            SKU <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                🏷️
                            </span>

                            <input
                                type="text"
                                name="sku"
                                value="{{ old('sku') }}"
                                placeholder="Contoh: SKU-0013"
                                class="form-input input-with-icon"
                                required
                            >

                        </div>

                        @error('sku')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Nama Produk <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                📦
                            </span>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Contoh: Indomie Goreng"
                                class="form-input input-with-icon"
                                required
                            >

                        </div>

                        @error('name')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- HARGA & STOK --}}
                <div class="form-row">

                    <div class="form-group">

                        <label class="form-label">
                            Harga Jual <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                💰
                            </span>

                            <input
                                type="number"
                                name="sell_price"
                                value="{{ old('sell_price') }}"
                                placeholder="Contoh: 12909"
                                min="0"
                                class="form-input input-with-icon"
                                required
                            >

                        </div>

                        @error('sell_price')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label class="form-label">
                            Stok <span class="required">*</span>
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                📊
                            </span>

                            <input
                                type="number"
                                name="stock"
                                value="{{ old('stock') }}"
                                placeholder="Contoh: 50"
                                min="0"
                                class="form-input input-with-icon"
                                required
                            >

                        </div>

                        @error('stock')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="form-actions">

                    <a
                        href="{{ route('products.index') }}"
                        class="btn btn-back"
                    >
                        ← Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-save"
                    >
                        ✓ Simpan Produk
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection