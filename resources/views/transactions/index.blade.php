@extends('layouts.app')

@section('content')

<style>

    [x-cloak] {
        display: none !important;
    }

    /* ==============================
       HALAMAN TRANSAKSI
    ============================== */

    .transaction-page {
        padding: 30px;
        background: #f3f6fb;
        min-height: calc(100vh - 70px);
    }

    .transaction-header {
        margin-bottom: 25px;
    }

    .transaction-title {
        font-size: 28px;
        font-weight: 800;
        color: #172033;
        margin: 0;
    }

    .transaction-subtitle {
        color: #7b8496;
        font-size: 14px;
        margin-top: 6px;
    }


    /* ==============================
       LAYOUT
    ============================== */

    .transaction-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 390px;
        gap: 22px;
        align-items: start;
    }


    /* ==============================
       PRODUK
    ============================== */

    .product-section {
        background: white;
        border-radius: 18px;
        padding: 22px;
        border: 1px solid #e5e9f2;
        box-shadow: 0 6px 20px rgba(0,0,0,.05);
    }

    .search-area {
        display: grid;
        grid-template-columns: 1fr 230px;
        gap: 14px;
        margin-bottom: 22px;
    }

    .input-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 7px;
    }

    .input-group input,
    .input-group select {
        width: 100%;
        box-sizing: border-box;
        padding: 11px 13px;
        border: 1px solid #d5dae4;
        border-radius: 10px;
        outline: none;
        font-size: 13px;
        background: white;
    }

    .input-group input:focus,
    .input-group select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,.10);
    }


    /* JUDUL DAFTAR PRODUK */

    .product-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .product-title {
        font-size: 17px;
        font-weight: 750;
        color: #172033;
        margin: 0;
    }

    .product-count {
        background: #eef2ff;
        color: #4f46e5;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }


    /* GRID PRODUK */

    .product-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }

    .product-card {
        background: #f8faff;
        border: 1px solid #e5e9f2;
        border-radius: 14px;
        padding: 16px;
        transition: .2s ease;
    }

    .product-card:hover {
        transform: translateY(-3px);
        border-color: #a5b4fc;
        box-shadow: 0 7px 16px rgba(79,70,229,.10);
    }

    .product-name {
        font-size: 14px;
        font-weight: 700;
        color: #273142;
    }

    .product-sku {
        font-size: 11px;
        color: #8b94a5;
        margin-top: 4px;
    }

    .product-category {
        font-size: 11px;
        color: #6b7280;
        margin-top: 3px;
    }

    .product-price {
        font-size: 17px;
        font-weight: 800;
        color: #4f46e5;
        margin-top: 13px;
    }

    .stock-badge {
        display: inline-block;
        margin-top: 8px;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
    }

    .stock-available {
        background: #dcfce7;
        color: #15803d;
    }

    .stock-empty {
        background: #fee2e2;
        color: #b91c1c;
    }

    .add-product {
        width: 100%;
        border: none;
        margin-top: 13px;
        padding: 9px;
        border-radius: 9px;
        background: #4f46e5;
        color: white;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
    }

    .add-product:hover {
        background: #4338ca;
    }

    .add-product:disabled {
        background: #cbd5e1;
        cursor: not-allowed;
    }


    /* ==============================
       KERANJANG
    ============================== */

    .cart-section {
        background: white;
        border-radius: 18px;
        padding: 22px;
        border: 1px solid #e5e9f2;
        box-shadow: 0 6px 20px rgba(0,0,0,.05);
        position: sticky;
        top: 20px;
    }

    .cart-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .cart-title {
        font-size: 18px;
        font-weight: 750;
        color: #172033;
        margin: 0;
    }

    .cart-count {
        font-size: 12px;
        color: #7b8496;
        margin-top: 3px;
    }

    .cart-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #eef2ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }


    /* KERANJANG KOSONG */

    .empty-cart {
        padding: 35px 15px;
        text-align: center;
        border: 1px dashed #d5dae4;
        border-radius: 13px;
        background: #fafbfc;
    }

    .empty-cart-icon {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .empty-cart-title {
        font-size: 13px;
        font-weight: 700;
        color: #4b5563;
    }

    .empty-cart-text {
        font-size: 11px;
        color: #9ca3af;
        margin-top: 5px;
    }


    /* ITEM KERANJANG */

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .cart-item {
        padding: 13px;
        border: 1px solid #e5e9f2;
        border-radius: 12px;
        background: #fafbff;
    }

    .cart-item-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .cart-item-name {
        font-size: 13px;
        font-weight: 700;
        color: #273142;
    }

    .cart-item-price {
        font-size: 11px;
        color: #7b8496;
        margin-top: 3px;
    }

    .remove-item {
        border: none;
        background: transparent;
        color: #ef4444;
        font-weight: 700;
        cursor: pointer;
        font-size: 15px;
    }

    .cart-item-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        border: 1px solid #d5dae4;
        border-radius: 8px;
        overflow: hidden;
        background: white;
    }

    .quantity-control button {
        border: none;
        background: white;
        padding: 5px 10px;
        cursor: pointer;
        font-size: 14px;
    }

    .quantity-control button:hover {
        background: #f3f4f6;
    }

    .quantity-number {
        padding: 5px 10px;
        font-weight: 700;
        font-size: 12px;
    }

    .cart-subtotal {
        font-size: 13px;
        font-weight: 700;
        color: #172033;
    }


    /* ==============================
       TOTAL
    ============================== */

    .cart-total {
        margin-top: 18px;
        padding-top: 17px;
        border-top: 1px solid #e5e9f2;
    }

    .subtotal-row {
        display: flex;
        justify-content: space-between;
        color: #7b8496;
        font-size: 12px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    .total-label {
        font-size: 16px;
        font-weight: 750;
        color: #172033;
    }

    .total-value {
        font-size: 19px;
        font-weight: 800;
        color: #4f46e5;
    }


    /* ==============================
       PEMBAYARAN
    ============================== */

    .payment-area {
        margin-top: 18px;
    }

    .payment-area label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 7px;
    }

    .payment-area input {
        width: 100%;
        box-sizing: border-box;
        padding: 11px;
        border: 1px solid #d5dae4;
        border-radius: 9px;
        outline: none;
    }

    .payment-area input:focus {
        border-color: #6366f1;
    }


    /* KEMBALIAN */

    .change-box {
        display: flex;
        justify-content: space-between;
        margin-top: 12px;
        padding: 11px;
        border-radius: 9px;
        background: #ecfdf5;
        color: #15803d;
        font-size: 12px;
    }


    /* CHECKOUT */

    .checkout-button {
        width: 100%;
        border: none;
        margin-top: 14px;
        padding: 12px;
        border-radius: 10px;
        background: #16a34a;
        color: white;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 5px 12px rgba(22,163,74,.20);
    }

    .checkout-button:hover {
        background: #15803d;
    }


    /* PRODUK TIDAK DITEMUKAN */

    .no-product {
        grid-column: 1 / -1;
        text-align: center;
        padding: 35px;
        color: #9ca3af;
        border: 1px dashed #d5dae4;
        border-radius: 12px;
        background: #fafbfc;
    }


    /* ==============================
       RESPONSIVE
    ============================== */

    @media (max-width: 1100px) {

        .transaction-layout {
            grid-template-columns: 1fr;
        }

        .cart-section {
            position: static;
        }

        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 800px) {

        .transaction-page {
            padding: 18px;
        }

        .search-area {
            grid-template-columns: 1fr;
        }

        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {

        .product-grid {
            grid-template-columns: 1fr;
        }

        .transaction-title {
            font-size: 24px;
        }
    }

</style>


<div x-data="cart()" class="transaction-page">


    {{-- ==============================
         HEADER
    ============================== --}}

    <div class="transaction-header">

        <h1 class="transaction-title">
            Transaksi
        </h1>

        <p class="transaction-subtitle">
            Kelola transaksi penjualan hari ini
        </p>

    </div>


    {{-- ==============================
         LAYOUT
    ============================== --}}

    <div class="transaction-layout">


        {{-- ==========================
             DAFTAR PRODUK
        =========================== --}}

        <div class="product-section">


            {{-- SEARCH --}}

            <div class="search-area">

                <div class="input-group">

                    <label>
                        Cari Produk
                    </label>

                    <input
                        type="text"
                        x-model="search"
                        x-on:input="search = $event.target.value"
                        placeholder="Cari nama produk atau SKU..."
                    >

                </div>


                {{-- KATEGORI --}}

                <div class="input-group">

                    <label>
                        Kategori
                    </label>

                    <select
                        x-model="selectedCategory"
                        @change="selectedCategory = $event.target.value"
                    >

                        <option value="">
                            Semua Kategori
                        </option>

                        @foreach ($categories as $category)

                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>



            {{-- HEADER PRODUK --}}

            <div class="product-header">

                <h2 class="product-title">
                    Daftar Produk
                </h2>

                <span class="product-count">
                    {{ $products->count() }} produk
                </span>

            </div>



            {{-- GRID PRODUK --}}

            <div class="product-grid">


                @forelse ($products as $product)


                    <div
                        class="product-card"
                        x-cloak
                        x-show="
                            (
                                search.trim() === '' ||
                                '{{ strtolower($product->name) }}'.includes(
                                    search.toLowerCase().trim()
                                ) ||
                                '{{ strtolower($product->sku) }}'.includes(
                                    search.toLowerCase().trim()
                                )
                            )
                            &&
                            (
                                selectedCategory === '' ||
                                selectedCategory == '{{ $product->category_id }}'
                            )
                        "
                    >


                        {{-- NAMA --}}

                        <div class="product-name">
                            {{ $product->name }}
                        </div>


                        {{-- SKU --}}

                        <div class="product-sku">
                            SKU: {{ $product->sku }}
                        </div>


                        {{-- KATEGORI --}}

                        <div class="product-category">
                            {{ $product->category->name ?? '-' }}
                        </div>


                        {{-- HARGA --}}

                        <div class="product-price">
                            Rp {{ number_format($product->sell_price, 0, ',', '.') }}
                        </div>


                        {{-- STOK --}}

                        @if ($product->stock > 0)

                            <span class="stock-badge stock-available">
                                Stok {{ $product->stock }}
                            </span>

                        @else

                            <span class="stock-badge stock-empty">
                                Stok Habis
                            </span>

                        @endif


                        {{-- TAMBAH --}}

                        <button
                            type="button"
                            class="add-product"

                            @click="add({
                                id: {{ $product->id }},
                                name: @js($product->name),
                                price: {{ $product->sell_price }},
                                stock: {{ $product->stock }}
                            })"

                            @if ($product->stock <= 0)
                                disabled
                            @endif
                        >

                            + Tambah

                        </button>


                    </div>


                @empty


                    <div class="no-product">
                        Belum ada produk.
                    </div>


                @endforelse


            </div>


        </div>



        {{-- ==========================
             KERANJANG
        =========================== --}}

        <div class="cart-section">


            {{-- HEADER --}}

            <div class="cart-header">

                <div>

                    <h2 class="cart-title">
                        Keranjang
                    </h2>

                    <div class="cart-count">
                        <span x-text="items.length"></span>
                        jenis produk
                    </div>

                </div>

                <div class="cart-icon">
                    🛒
                </div>

            </div>



            {{-- KERANJANG KOSONG --}}

            <div
                x-show="items.length === 0"
                class="empty-cart"
            >

                <div class="empty-cart-icon">
                    🛒
                </div>

                <div class="empty-cart-title">
                    Keranjang masih kosong
                </div>

                <div class="empty-cart-text">
                    Pilih produk untuk menambahkannya ke keranjang.
                </div>

            </div>



            {{-- ITEM KERANJANG --}}

            <div
                x-show="items.length > 0"
                class="cart-items"
            >

                <template
                    x-for="item in items"
                    :key="item.id"
                >

                    <div class="cart-item">


                        {{-- ATAS --}}

                        <div class="cart-item-top">

                            <div>

                                <div
                                    class="cart-item-name"
                                    x-text="item.name"
                                ></div>

                                <div class="cart-item-price">

                                    Rp
                                    <span
                                        x-text="formatRupiah(item.price)"
                                    ></span>

                                </div>

                            </div>


                            {{-- HAPUS --}}

                            <button
                                type="button"
                                class="remove-item"
                                @click="remove(item.id)"
                            >
                                ✕
                            </button>

                        </div>



                        {{-- BAWAH --}}

                        <div class="cart-item-bottom">


                            {{-- QUANTITY --}}

                            <div class="quantity-control">

                                <button
                                    type="button"
                                    @click="decrease(item.id)"
                                >
                                    −
                                </button>

                                <span
                                    class="quantity-number"
                                    x-text="item.qty"
                                ></span>

                                <button
                                    type="button"
                                    @click="increase(item.id)"
                                >
                                    +
                                </button>

                            </div>


                            {{-- SUBTOTAL --}}

                            <div class="cart-subtotal">

                                Rp
                                <span
                                    x-text="formatRupiah(item.price * item.qty)"
                                ></span>

                            </div>


                        </div>


                    </div>

                </template>

            </div>



            {{-- ==========================
                 TOTAL
            =========================== --}}

            <div
                x-show="items.length > 0"
                class="cart-total"
            >

                <div class="subtotal-row">

                    <span>
                        Subtotal
                    </span>

                    <span>
                        Rp
                        <span x-text="formatRupiah(total)"></span>
                    </span>

                </div>


                <div class="total-row">

                    <span class="total-label">
                        Total
                    </span>

                    <span class="total-value">

                        Rp
                        <span x-text="formatRupiah(total)"></span>

                    </span>

                </div>

            </div>



            {{-- ==========================
                 PEMBAYARAN
            =========================== --}}

            <div
                x-show="items.length > 0"
                class="payment-area"
            >

                <label>
                    Uang Dibayar
                </label>

                <input
                    type="number"
                    x-model.number="paid"
                    min="0"
                    placeholder="Masukkan uang pembayaran"
                >

            </div>



            {{-- KEMBALIAN --}}

            <div
                x-show="items.length > 0 && paid >= total"
                class="change-box"
            >

                <span>
                    Kembalian
                </span>

                <strong>

                    Rp
                    <span x-text="formatRupiah(change)"></span>

                </strong>

            </div>



            {{-- ==========================
                 FORM CHECKOUT
            =========================== --}}

            <form
                method="POST"
                action="{{ route('transactions.store') }}"
                @submit="if (!prepareCheckout()) $event.preventDefault()"
            >

                @csrf


                {{-- DATA ITEM --}}

                <template
                    x-for="(item, index) in items"
                    :key="item.id"
                >

                    <div>

                        <input
                            type="hidden"
                            :name="`items[${index}][product_id]`"
                            :value="item.id"
                        >

                        <input
                            type="hidden"
                            :name="`items[${index}][quantity]`"
                            :value="item.qty"
                        >

                    </div>

                </template>


                {{-- UANG DIBAYAR --}}

                <input
                    type="hidden"
                    name="paid_amount"
                    :value="paid"
                >


                {{-- CHECKOUT --}}

                <button
                    type="submit"
                    x-show="items.length > 0"
                    class="checkout-button"
                >
                    Checkout
                </button>

            </form>


        </div>


    </div>


</div>



@push('scripts')

<script>

function cart() {

    return {

        items: [],

        paid: 0,

        /* ==========================
           SEARCH
        =========================== */

        search: '',

        selectedCategory: '',


        /* ==========================
           FILTER PRODUK
        =========================== */

        matchesProduct(name, sku, categoryId) {

            let keyword = this.search
                .toLowerCase()
                .trim();

            let productName = name
                .toLowerCase();

            let productSku = sku
                .toLowerCase();


            let matchesSearch =
                productName.includes(keyword) ||
                productSku.includes(keyword);


            let matchesCategory =
                this.selectedCategory === '' ||
                String(categoryId) === String(this.selectedCategory);


            return matchesSearch && matchesCategory;

        },


        /* ==========================
           VALIDASI CHECKOUT
        =========================== */

        prepareCheckout() {

            if (this.items.length === 0) {

                alert('Keranjang masih kosong.');

                return false;

            }


            if (this.paid < this.total) {

                alert(
                    'Uang pembayaran kurang dari total transaksi.'
                );

                return false;

            }


            return true;

        },


        /* ==========================
           TAMBAH PRODUK
        =========================== */

        add(product) {

            let item = this.items.find(
                item => item.id === product.id
            );


            if (item) {

                if (item.qty >= item.stock) {

                    alert(
                        `Stok ${item.name} tidak mencukupi. Stok tersedia hanya ${item.stock}.`
                    );

                    return;

                }

                item.qty++;

                return;

            }


            this.items.push({

                id: product.id,

                name: product.name,

                price: Number(product.price),

                stock: Number(product.stock),

                qty: 1

            });

        },


        /* ==========================
           TAMBAH QTY
        =========================== */

        increase(id) {

            let item = this.items.find(
                item => item.id === id
            );


            if (!item) {

                return;

            }


            if (item.qty >= item.stock) {

                alert(
                    `Stok ${item.name} tidak mencukupi. Stok tersedia hanya ${item.stock}.`
                );

                return;

            }


            item.qty++;

        },


        /* ==========================
           KURANG QTY
        =========================== */

        decrease(id) {

            let item = this.items.find(
                item => item.id === id
            );


            if (!item) {

                return;

            }


            if (item.qty > 1) {

                item.qty--;

            }

        },


        /* ==========================
           HAPUS ITEM
        =========================== */

        remove(id) {

            this.items = this.items.filter(
                item => item.id !== id
            );

        },


        /* ==========================
           TOTAL
        =========================== */

        get total() {

            return this.items.reduce(

                (total, item) => {

                    return total +
                        (item.price * item.qty);

                },

                0

            );

        },


        /* ==========================
           KEMBALIAN
        =========================== */

        get change() {

            return Math.max(
                0,
                this.paid - this.total
            );

        },


        /* ==========================
           FORMAT RUPIAH
        =========================== */

        formatRupiah(number) {

            return new Intl.NumberFormat(
                'id-ID'
            ).format(number);

        }

    };

}

</script>

@endpush

@endsection