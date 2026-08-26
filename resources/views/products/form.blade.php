<div class="mb-4">
    <label class="block font-medium mb-2">Kategori</label>

    <select name="category_id" class="w-full border rounded px-3 py-2">
        <option value="">-- Pilih Kategori --</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-medium mb-2">SKU</label>

    <input
        type="text"
        name="sku"
        value="{{ old('sku', $product->sku ?? '') }}"
        class="w-full border rounded px-3 py-2">

    @error('sku')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-medium mb-2">Nama Produk</label>

    <input
        type="text"
        name="name"
        value="{{ old('name', $product->name ?? '') }}"
        class="w-full border rounded px-3 py-2">

    @error('name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-medium mb-2">Harga Jual</label>

    <input
        type="number"
        name="sell_price"
        value="{{ old('sell_price', $product->sell_price ?? '') }}"
        class="w-full border rounded px-3 py-2">

    @error('sell_price')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

<div class="mb-6">
    <label class="block font-medium mb-2">Stok</label>

    <input
        type="number"
        name="stock"
        value="{{ old('stock', $product->stock ?? '') }}"
        class="w-full border rounded px-3 py-2">

    @error('stock')
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>