<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GadgetInventory - Laravel P5')</title>
    <!-- Tailwind CSS & FontAwesome Icons CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-900 text-slate-100 font-sans min-h-screen flex flex-col antialiased">

    <!-- Navbar Header -->
    <header class="bg-slate-800/90 backdrop-blur-md border-b border-slate-700/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Brand Logo -->
                <a href="{{ route('products.index') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-500 to-blue-600 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                        <i class="fa-solid fa-bolt text-white text-lg"></i>
                    </div>
                    <div>
                        <span class="font-extrabold text-lg text-white tracking-wide">Gadget<span class="text-cyan-400">Inventory</span></span>
                        <p class="text-[10px] text-slate-400 -mt-1 font-mono uppercase tracking-wider">Laravel 10 • Pertemuan 5</p>
                    </div>
                </a>

                <!-- Navigation Links -->
                <nav class="flex items-center space-x-3 text-sm font-medium">
                    <a href="{{ route('products.index') }}" class="px-3 py-2 rounded-lg {{ request()->routeIs('products.*') ? 'bg-slate-700 text-white font-semibold' : 'text-slate-300 hover:text-white hover:bg-slate-700/50' }} transition">
                        <i class="fa-solid fa-laptop-code mr-1.5 text-cyan-400"></i> Katalog Produk
                    </a>
                    <a href="{{ route('products.create') }}" class="bg-cyan-600 hover:bg-cyan-500 text-white px-3.5 py-2 rounded-lg text-xs font-semibold shadow-md shadow-cyan-600/30 transition flex items-center">
                        <i class="fa-solid fa-plus mr-1.5"></i> Tambah Produk
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full">
        <!-- Flash Alert Success (Blade Component) -->
        @if(session('success'))
            <div class="mb-6">
                <x-alert type="success">
                    <div class="flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                    </div>
                </x-alert>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800 bg-slate-900/60 py-6 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} GadgetInventory - Electronics & Gadget Store. Laravel Fundamental P5.</p>
    </footer>

</body>
</html>
