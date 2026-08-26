@extends('layouts.app')

@section('content')

<style>
    /* ==============================
       HALAMAN KATEGORI
    ============================== */

    .category-page {
        background: #f5f7fb;
        min-height: calc(100vh - 70px);
        padding: 40px 50px;
    }

    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .category-title {
        margin: 0;
        font-size: 30px;
        font-weight: 700;
        color: #102a56;
    }

    .category-subtitle {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    /* Tombol tambah */
    .btn-add-category {
        background: #4f46e5;
        color: white;
        padding: 13px 20px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border: none;
        transition: .2s;
        box-shadow: 0 5px 12px rgba(79, 70, 229, .20);
    }

    .btn-add-category:hover {
        background: #4338ca;
        transform: translateY(-1px);
    }

    /* ==============================
       CARD TABLE
    ============================== */

    .category-card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 5px 18px rgba(15, 23, 42, .05);
        overflow: hidden;
    }

    .category-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 22px 26px;
        border-bottom: 1px solid #e5e7eb;
    }

    .category-card-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #102a56;
    }

    .category-count {
        color: #64748b;
        font-size: 14px;
    }

    /* ==============================
       TABLE
    ============================== */

    .category-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .category-table th {
        background: #f8fafc;
        color: #334155;
        font-size: 14px;
        font-weight: 700;
        padding: 16px 18px;
        border-bottom: 1px solid #e2e8f0;
        text-align: left;
    }

    .category-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #e5e7eb;
        color: #1e293b;
        font-size: 14px;
        vertical-align: middle;
    }

    .category-table tbody tr:last-child td {
        border-bottom: none;
    }

    .category-table tbody tr:hover {
        background: #f8fafc;
    }

    /* Lebar kolom */
    .col-no {
        width: 80px;
        text-align: center !important;
    }

    .col-name {
        width: auto;
    }

    .col-action {
        width: 250px;
        text-align: center !important;
    }

    /* Nomor */
    .number-badge {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #eef2ff;
        color: #4f46e5;
        font-weight: 700;
    }

    /* Nama kategori */
    .category-name {
        font-weight: 600;
        color: #172554;
    }

    /* ==============================
       BUTTON AKSI
    ============================== */

    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .btn-edit {
        background: #facc15;
        color: #422006;
        padding: 9px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-edit:hover {
        background: #eab308;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
        padding: 9px 18px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    /* Data kosong */
    .empty-category {
        text-align: center !important;
        padding: 40px !important;
        color: #94a3b8 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .category-page {
            padding: 25px 15px;
        }

        .category-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 18px;
        }

        .category-table {
            min-width: 600px;
        }

        .category-card {
            overflow-x: auto;
        }
    }
</style>


<div class="category-page">

    {{-- HEADER --}}
    <div class="category-header">

        <div>
            <h1 class="category-title">
                Data Kategori
            </h1>

            <p class="category-subtitle">
                Kelola kategori produk dengan mudah dan teratur.
            </p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="btn-add-category">
            + Tambah Kategori
        </a>

    </div>


    {{-- CARD --}}
    <div class="category-card">

        <div class="category-card-header">

            <h2 class="category-card-title">
                Daftar Kategori
            </h2>

            <span class="category-count">
                {{ $categories->count() }} kategori
            </span>

        </div>


        {{-- TABLE --}}
        <table class="category-table">

            <thead>
                <tr>

                    <th class="col-no">
                        No
                    </th>

                    <th class="col-name">
                        Nama Kategori
                    </th>

                    <th class="col-action">
                        Aksi
                    </th>

                </tr>
            </thead>


            <tbody>

                @forelse($categories as $category)

                    <tr>

                        {{-- NO --}}
                        <td class="col-no">
                            <span class="number-badge">
                                {{ $loop->iteration }}
                            </span>
                        </td>


                        {{-- NAMA --}}
                        <td class="col-name">

                            <span class="category-name">
                                {{ $category->name }}
                            </span>

                        </td>


                        {{-- AKSI --}}
                        <td class="col-action">

                            <div class="action-buttons">

                                {{-- EDIT --}}
                                <a href="{{ route('categories.edit', $category->id) }}"
                                   class="btn-edit">
                                    ✏️ Edit
                                </a>


                                {{-- HAPUS --}}
                                <form action="{{ route('categories.destroy', $category->id) }}"
                                      method="POST"
                                      style="margin:0;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="empty-category">
                            Belum ada data kategori.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection