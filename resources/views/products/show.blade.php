@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header & Navigation -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                <i class="fa-solid fa-cube mr-3 text-cyan-400"></i> Detail Informasi Produk
            </h1>
            <p class="text-xs text-slate-400 mt-1">Spesifikasi dan ketersediaan stok barang di inventaris.</p>
        </div>
        <a href="{{ route('products.index') }}" class="text-slate-400 hover:text-white text-sm font-semibold flex items-center transition">
            <i class="fa-solid fa-arrow-left mr-1.5"></i> Kembali ke Daftar
        </a>
    </div>

    <!-- Product Card -->
    <div class="bg-slate-800/60 rounded-2xl border border-slate-700/60 p-6 sm:p-8 shadow-xl space-y-6">

        <!-- Top Overview -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-6 border-b border-slate-700/60 gap-4">
            <div>
                <span class="inline-block text-xs font-mono font-bold text-cyan-400 bg-cyan-950/80 border border-cyan-800/60 px-3 py-1 rounded-lg uppercase tracking-wider mb-2">
                    SKU: {{ $product->sku }}
                </span>
                <h2 class="text-2xl font-extrabold text-white">{{ $product->name }}</h2>
                <p class="text-xs text-slate-400 mt-1 flex items-center">
                    <i class="fa-solid fa-tag mr-1.5 text-slate-500"></i> Kategori: 
                    <span class="text-slate-200 font-semibold ml-1">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                </p>
            </div>
            <div class="text-left sm:text-right">
                <span class="text-xs text-slate-400 uppercase tracking-wider block font-semibold">Harga Satuan</span>
                <span class="text-2xl font-black text-cyan-400">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Stock Status Box -->
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-700/50">
                <span class="text-xs text-slate-400 uppercase font-semibold tracking-wider block mb-1">Status Ketersediaan Stok</span>
                <div class="flex items-center space-x-3 mt-2">
                    <span class="text-3xl font-extrabold text-white">{{ $product->stock }}</span>
                    <span class="text-xs text-slate-400">unit</span>
                    @if($product->isLowStock())
                        <span class="bg-rose-500/20 text-rose-300 border border-rose-500/30 text-xs px-2.5 py-1 rounded-full font-semibold flex items-center">
                            <i class="fa-solid fa-triangle-exclamation mr-1"></i> Stok Menipis!
                        </span>
                    @else
                        <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs px-2.5 py-1 rounded-full font-semibold flex items-center">
                            <i class="fa-solid fa-circle-check mr-1"></i> Stok Aman
                        </span>
                    @endif
                </div>
            </div>

            <!-- Minimum Stock Box -->
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-700/50">
                <span class="text-xs text-slate-400 uppercase font-semibold tracking-wider block mb-1">Batas Minimum Stok (Threshold)</span>
                <div class="flex items-center space-x-3 mt-2">
                    <span class="text-3xl font-extrabold text-slate-300">{{ $product->minimum_stock }}</span>
                    <span class="text-xs text-slate-400">unit</span>
                    <p class="text-[11px] text-slate-500">Peringatan aktif jika stok &le; {{ $product->minimum_stock }} unit</p>
                </div>
            </div>
        </div>

        <!-- Metadata -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-slate-400 bg-slate-900/30 p-4 rounded-xl border border-slate-800">
            <div>
                <i class="fa-solid fa-calendar-plus mr-1 text-slate-500"></i> Ditambahkan: 
                <span class="text-slate-300 font-medium">{{ $product->created_at ? $product->created_at->format('d M Y, H:i') : '-' }}</span>
            </div>
            <div>
                <i class="fa-solid fa-clock-rotate-left mr-1 text-slate-500"></i> Terakhir Diperbarui: 
                <span class="text-slate-300 font-medium">{{ $product->updated_at ? $product->updated_at->format('d M Y, H:i') : '-' }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-4 border-t border-slate-700/60">
            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-400 hover:text-white hover:bg-slate-700/50 transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a>
            <div class="flex items-center space-x-3">
                <a href="{{ route('products.edit', $product) }}" class="bg-amber-600 hover:bg-amber-500 text-white font-semibold px-4 py-2 rounded-xl text-sm shadow transition flex items-center">
                    <i class="fa-solid fa-pen mr-1.5"></i> Edit Produk
                </a>
                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-rose-600/30 hover:bg-rose-600 text-rose-300 hover:text-white font-semibold px-4 py-2 rounded-xl text-sm border border-rose-500/40 transition flex items-center">
                        <i class="fa-solid fa-trash mr-1.5"></i> Hapus
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection
