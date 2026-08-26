@extends('layouts.app')

@section('content')

<style>
    /* =========================
       HALAMAN TAMBAH KATEGORI
    ========================= */

    .category-create-page {
        background: #f5f7fb;
        min-height: calc(100vh - 70px);
        padding: 40px 50px;
    }

    .create-header {
        margin-bottom: 25px;
    }

    .create-title {
        margin: 0;
        font-size: 30px;
        font-weight: 700;
        color: #102a56;
    }

    .create-subtitle {
        margin-top: 8px;
        color: #64748b;
        font-size: 15px;
    }

    /* =========================
       CARD FORM
    ========================= */

    .form-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .05);
        padding: 30px;
        max-width: 100%;
    }

    .form-card-title {
        margin: 0 0 25px;
        font-size: 19px;
        font-weight: 700;
        color: #102a56;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        margin-bottom: 9px;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    .form-input {
        width: 100%;
        height: 48px;
        padding: 0 14px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        outline: none;
        font-size: 14px;
        color: #1e293b;
        background: white;
        box-sizing: border-box;
        transition: .2s;
    }

    .form-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, .10);
    }

    .form-input::placeholder {
        color: #94a3b8;
    }

    /* =========================
       BUTTON
    ========================= */

    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 5px;
    }

    .btn-save {
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 11px 22px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
        box-shadow: 0 4px 10px rgba(79, 70, 229, .18);
    }

    .btn-save:hover {
        background: #4338ca;
        transform: translateY(-1px);
    }

    .btn-back {
        background: #64748b;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 11px 22px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s;
    }

    .btn-back:hover {
        background: #475569;
    }

    /* =========================
       ERROR
    ========================= */

    .error-message {
        margin-top: 7px;
        color: #dc2626;
        font-size: 13px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .category-create-page {
            padding: 25px 15px;
        }

        .form-card {
            padding: 22px;
        }

        .create-title {
            font-size: 25px;
        }
    }
</style>


<div class="category-create-page">

    {{-- HEADER --}}
    <div class="create-header">

        <h1 class="create-title">
            Tambah Kategori
        </h1>

        <p class="create-subtitle">
            Tambahkan kategori baru untuk mengelompokkan produk.
        </p>

    </div>


    {{-- FORM CARD --}}
    <div class="form-card">

        <h2 class="form-card-title">
            Informasi Kategori
        </h2>


        <form action="{{ route('categories.store') }}" method="POST">

            @csrf


            {{-- NAMA KATEGORI --}}
            <div class="form-group">

                <label for="name" class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Makanan"
                    class="form-input"
                    required
                >

                @error('name')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- BUTTON --}}
            <div class="form-actions">

                <button type="submit" class="btn-save">
                    💾 Simpan
                </button>

                <a href="{{ route('categories.index') }}"
                   class="btn-back">
                    ← Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection