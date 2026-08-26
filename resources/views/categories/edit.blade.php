@extends('layouts.app')

@section('content')

<style>
    /* ===== HALAMAN EDIT KATEGORI ===== */

    .edit-category-page {
        min-height: calc(100vh - 70px);
        background: #f5f7fb;
        padding: 35px 30px;
    }

    .edit-category-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Header */
    .edit-category-header {
        margin-bottom: 25px;
    }

    .edit-category-header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #172554;
    }

    .edit-category-header p {
        margin-top: 8px;
        margin-bottom: 0;
        color: #64748b;
        font-size: 15px;
    }

    /* Card */
    .edit-category-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.06);
        padding: 30px;
    }

    .edit-category-title {
        font-size: 20px;
        font-weight: 700;
        color: #172554;
        margin-bottom: 28px;
    }

    /* Form */
    .category-form-group {
        margin-bottom: 22px;
    }

    .category-form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    .category-input {
        width: 100%;
        height: 46px;
        padding: 0 14px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #ffffff;
        color: #1e293b;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
        transition: all 0.2s ease;
    }

    .category-input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.10);
    }

    /* Error */
    .category-error {
        margin-top: 6px;
        font-size: 13px;
        color: #dc2626;
    }

    /* Tombol */
    .category-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid #e2e8f0;
    }

    .category-btn {
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
    }

    .category-btn-update {
        background: #4f46e5;
        color: white;
    }

    .category-btn-update:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
    }

    .category-btn-back {
        background: #e2e8f0;
        color: #334155;
    }

    .category-btn-back:hover {
        background: #cbd5e1;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .edit-category-page {
            padding: 25px 15px;
        }

        .edit-category-card {
            padding: 22px;
        }

        .edit-category-header h1 {
            font-size: 24px;
        }

        .category-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .category-btn {
            width: 100%;
        }
    }
</style>


<div class="edit-category-page">

    <div class="edit-category-container">

        <!-- Header -->
        <div class="edit-category-header">
            <h1>Edit Kategori</h1>
            <p>Ubah nama kategori produk yang sudah tersedia.</p>
        </div>


        <!-- Card -->
        <div class="edit-category-card">

            <div class="edit-category-title">
                Informasi Kategori
            </div>


            <!-- Form -->
            <form
                action="{{ route('categories.update', $category->id) }}"
                method="POST">

                @csrf
                @method('PUT')


                <!-- Nama Kategori -->
                <div class="category-form-group">

                    <label for="name">
                        Nama Kategori
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $category->name) }}"
                        class="category-input"
                        placeholder="Masukkan nama kategori"
                        required
                        autofocus>

                    @error('name')
                        <div class="category-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <!-- Tombol -->
                <div class="category-actions">

                    <button
                        type="submit"
                        class="category-btn category-btn-update">
                        ✓ Update
                    </button>

                    <a
                        href="{{ route('categories.index') }}"
                        class="category-btn category-btn-back">
                        ← Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection