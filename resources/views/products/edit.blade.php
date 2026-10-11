@extends('layouts.app')

@section('title', 'Edit Produk - ' . $product->name)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    <!-- Header & Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                <i class="fa-solid fa-pen-to-square mr-3 text-amber-400"></i> Edit Produk
            </h1>
            <p class="text-xs text-slate-400 mt-1">Perbarui data produk {{ $product->name }} ({{ $product->sku }}).</p>
        </div>
        <a href="{{ route('products.index') }}" class="text-slate-400 hover:text-white text-sm font-semibold flex items-center transition">
            <i class="fa-solid fa-arrow-left mr-1.5"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-slate-800/60 p-6 sm:p-8 rounded-2xl border border-slate-700/60 shadow-xl">
        <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Grid 1: SKU & Kategori -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- SKU -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        SKU / Kode Barang <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                        class="w-full bg-slate-900 border @error('sku') border-rose-500 @else border-slate-700 @enderror rounded-xl px-3.5 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-cyan-500 transition">
                    @error('sku')
                        <p class="text-rose-400 text-xs mt-1.5 flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Kategori <span class="text-rose-400">*</span>
                    </label>
                    <select name="category_id" 
                        class="w-full bg-slate-900 border @error('category_id') border-rose-500 @else border-slate-700 @enderror rounded-xl px-3.5 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-cyan-500 transition">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-rose-400 text-xs mt-1.5 flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Nama Produk -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                    Nama Produk <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="w-full bg-slate-900 border @error('name') border-rose-500 @else border-slate-700 @enderror rounded-xl px-3.5 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-cyan-500 transition">
                @error('name')
                    <p class="text-rose-400 text-xs mt-1.5 flex items-center">
                        <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Harga Satuan -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                    Harga Satuan (Rp) <span class="text-rose-400">*</span>
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500 text-sm font-semibold">Rp</span>
                    <input type="number" step="any" name="price" value="{{ old('price', $product->price) }}"
                        class="w-full bg-slate-900 border @error('price') border-rose-500 @else border-slate-700 @enderror rounded-xl pl-11 pr-3.5 py-2.5 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-cyan-500 transition">
                </div>
                @error('price')
                    <p class="text-rose-400 text-xs mt-1.5 flex items-center">
                        <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Grid 2: Stok & Minimum Stok -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Stok -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Stok Saat Ini <span class="text-rose-400">*</span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                        class="w-full bg-slate-900 border @error('stock') border-rose-500 @else border-slate-700 @enderror rounded-xl px-3.5 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-cyan-500 transition">
                    @error('stock')
                        <p class="text-rose-400 text-xs mt-1.5 flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Minimum Stok -->
                <div>
                    <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">
                        Batas Minimum Stok <span class="text-rose-400">*</span>
                    </label>
                    <input type="number" name="minimum_stock" value="{{ old('minimum_stock', $product->minimum_stock) }}" min="0"
                        class="w-full bg-slate-900 border @error('minimum_stock') border-rose-500 @else border-slate-700 @enderror rounded-xl px-3.5 py-2.5 text-sm text-slate-200 focus:outline-none focus:border-cyan-500 transition">
                    @error('minimum_stock')
                        <p class="text-rose-400 text-xs mt-1.5 flex items-center">
                            <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-700/60">
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-400 hover:text-white hover:bg-slate-700/50 transition">
                    Batal
                </a>
                <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white font-semibold px-6 py-2.5 rounded-xl text-sm shadow-lg shadow-amber-600/30 transition flex items-center">
                    <i class="fa-solid fa-check mr-2"></i> Perbarui Produk
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
