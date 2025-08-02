<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Custom CSS Animasi -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Animasi masuk halaman */
        .fade-slide-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-slide-in.loaded {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <script>
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });
    </script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="fade-slide-in antialiased bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">

    <!-- NAVIGATION -->
    <nav class="bg-white dark:bg-gray-800 shadow mb-6">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <span class="text-3xl font-bold text-yellow-500 drop-shadow-md">Arrafi</span>
                <span class="text-2xl font-semibold text-purple-600 flex items-center gap-1">
                    Store <span class="animate-pulse">🛍️</span>
                </span>
            </a>

            <div class="space-x-6">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-blue-500">Dashboard</a>
                <a href="{{ route('products.index') }}" class="text-sm font-medium hover:text-blue-500">Produk</a>
                <a href="{{ route('cart.index') }}" class="text-sm font-medium hover:text-blue-500">Keranjang</a>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium hover:text-red-500">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- PAGE HEADER -->
    @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <!-- Floating Cart Button -->
    <a href="{{ route('cart.index') }}"
       class="fixed bottom-6 right-12 bg-blue-600 hover:bg-blue-700 text-white p-5 rounded-full shadow-xl z-50 
              transform transition duration-300 hover:scale-110 animate-bounce"
       title="Lihat Keranjang">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.5h12.2m-14-4.2V6m5 10a1 1 0 110 2 1 1 0 010-2zm8 0a1 1 0 110 2 1 1 0 010-2z" />
        </svg>
    </a>

</body>
</html>
