@extends('layouts.app')

@section('title', 'Katalog Produk - GadgetInventory')

@section('content')
<div class="space-y-6">

    <!-- Header & Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-800/50 p-6 rounded-2xl border border-slate-700/60 shadow-lg">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                <i class="fa-solid fa-boxes-stacked mr-3 text-cyan-400"></i> Katalog Produk
            </h1>
            <p class="text-xs text-slate-400 mt-1">Kelola data inventaris produk, status stok, dan kategori barang.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('products.create') }}" class="bg-cyan-600 hover:bg-cyan-500 text-white px-4 py-2.5 rounded-xl text-sm font-semibold shadow-md shadow-cyan-600/30 transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Produk Baru
            </a>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-slate-800/40 p-4 rounded-2xl border border-slate-700/60 shadow">
        <form method="GET" action="{{ route('products.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
            <!-- Search Keyword -->
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Cari Produk / SKU</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-500">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama atau SKU..." 
                        class="w-full bg-slate-900 border border-slate-700 rounded-xl pl-9 pr-3 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-cyan-500 transition">
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Filter Kategori</label>
                <select name="category_id" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-sm text-slate-200 focus:outline-none focus:border-cyan-500 transition">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sort By -->
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Urutan (Sort)</label>
                <div class="grid grid-cols-2 gap-2">
                    <select name="sort" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-2.5 py-2 text-sm text-slate-200 focus:outline-none focus:border-cyan-500 transition">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama</option>
                        <option value="sku" {{ request('sort') == 'sku' ? 'selected' : '' }}>SKU</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Harga</option>
                        <option value="stock" {{ request('sort') == 'stock' ? 'selected' : '' }}>Stok</option>
                    </select>
                    <select name="direction" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-2.5 py-2 text-sm text-slate-200 focus:outline-none focus:border-cyan-500 transition">
                        <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Asc (A-Z)</option>
                        <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Desc (Z-A)</option>
                    </select>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="flex space-x-2">
                <button type="submit" class="flex-1 bg-slate-700 hover:bg-slate-600 text-white font-semibold py-2 px-4 rounded-xl text-sm transition flex items-center justify-center">
                    <i class="fa-solid fa-filter mr-1.5"></i> Terapkan
                </button>
                @if(request()->hasAny(['search', 'category_id', 'sort', 'direction']))
                    <a href="{{ route('products.index') }}" class="bg-rose-500/20 hover:bg-rose-500/30 text-rose-300 font-semibold py-2 px-3 rounded-xl text-sm transition flex items-center justify-center" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Product Table -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/60 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-800 text-xs uppercase font-semibold text-slate-400 border-b border-slate-700/80 tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">SKU</th>
                        <th class="py-3.5 px-4">Nama Produk</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4 text-right">Harga</th>
                        <th class="py-3.5 px-4 text-center">Stok Saat Ini</th>
                        <th class="py-3.5 px-4 text-center">Min. Stok</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-700/30 transition">
                            <!-- SKU -->
                            <td class="py-3.5 px-4 font-mono font-medium text-cyan-400">
                                {{ $product->sku }}
                            </td>

                            <!-- Product Name -->
                            <td class="py-3.5 px-4 font-semibold text-white">
                                <a href="{{ route('products.show', $product) }}" class="hover:text-cyan-400 transition">
                                    {{ $product->name }}
                                </a>
                            </td>

                            <!-- Category -->
                            <td class="py-3.5 px-4">
                                <span class="bg-slate-700 text-slate-300 text-xs px-2.5 py-1 rounded-lg border border-slate-600 font-medium">
                                    {{ $product->category->name ?? 'Tanpa Kategori' }}
                                </span>
                            </td>

                            <!-- Price -->
                            <td class="py-3.5 px-4 text-right font-medium text-slate-100">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            <!-- Stock (with Low Stock Alert) -->
                            <td class="py-3.5 px-4 text-center">
                                @if($product->isLowStock())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-500/20 text-rose-300 border border-rose-500/30 animate-pulse">
                                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $product->stock }} (Menipis!)
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                        <i class="fa-solid fa-check mr-1"></i> {{ $product->stock }}
                                    </span>
                                @endif
                            </td>

                            <!-- Minimum Stock -->
                            <td class="py-3.5 px-4 text-center text-slate-400 font-mono">
                                {{ $product->minimum_stock }}
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Show Detail -->
                                    <a href="{{ route('products.show', $product) }}" class="p-1.5 rounded-lg bg-slate-700 hover:bg-slate-600 text-slate-200 transition" title="Lihat Detail">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('products.edit', $product) }}" class="p-1.5 rounded-lg bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 transition" title="Edit Data">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>

                                    <!-- Delete Form -->
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }}?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg bg-rose-500/20 hover:bg-rose-500/30 text-rose-300 transition" title="Hapus Produk">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-500">
                                <i class="fa-solid fa-box-open text-4xl mb-3 block text-slate-600"></i>
                                Tidak ada data produk yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        @if($products->hasPages())
            <div class="p-4 border-t border-slate-700/80 bg-slate-800/80">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
