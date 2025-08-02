@extends('layouts.app') 

@section('content')
<div class="max-w-7xl mx-auto py-6">

    <!-- Tombol tambah produk -->
    <div class="mb-4">
        <a href="{{ route('products.create') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            + Tambah Produk
        </a>
    </div>

<!-- Wallet dan Profil Singkat -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold text-gray-700 flex justify-between items-center">
            Wallet Saya
            <button type="button" onclick="toggleWallet()" class="text-gray-600 hover:text-blue-600">
                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
        </h2>
        <p id="walletAmount" class="text-3xl font-bold text-blue-600 mb-2">
    Rp {{ number_format($user->wallet, 0, ',', '.') }}
</p>

<!-- Tombol tampilkan form -->
<button onclick="toggleTopUp()" class="text-sm text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded mb-2">
    Top Up
</button>

<!-- Form Top Up (hidden by default) -->
<div id="topUpForm" class="hidden">
    <form action="{{ route('wallet.topup') }}" method="POST" class="flex flex-col sm:flex-row gap-2 items-start sm:items-center">
        @csrf
<input type="number" name="amount" min="1000" step="1000" required
       placeholder="Jumlah top up"
       class="w-full sm:w-40 border border-gray-300 rounded py-1 px-3 focus:outline-none focus:ring-2 focus:ring-blue-300 text-black">

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
            Kirim
        </button>
    </form>
</div>

    </div>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Profil Saya</h2>
            <p class="text-base text-gray-800 font-semibold">{{ $user->name }}</p>
            <p class="text-sm text-gray-600">{{ $user->email }}</p>
        </div>
    </div>

    <!-- Filter: Pencarian dan Urutkan -->
    <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap md:flex-nowrap items-center justify-end gap-4 mb-6">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari produk..."
            class="w-full md:w-64 border border-gray-400 rounded-md py-2 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-sm">

        <select name="sort" onchange="this.form.submit()"
            class="w-full md:w-48 border border-gray-400 bg-white text-black font-medium text-base rounded-md py-2 px-4 shadow-sm hover:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <option value="">Urutkan</option>
            <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
            <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal</option>
            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
        </select>

        <a href="{{ route('dashboard') }}"
            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium px-4 py-2 rounded shadow-sm">
            Reset
        </a>
    </form>

    <!-- Kategori Ikon -->
    <div class="mb-6">
        <div class="flex flex-wrap gap-4">
            @foreach ($kategoriList as $kategori)
                @php
                    $slug = Str::slug($kategori->nama_kategori);
                    $basePath = public_path("icons/{$slug}");
                    $webPath = asset("icons/{$slug}");

                    if (file_exists(public_path("icons/{$slug}.jpg"))) {
                        $iconPath = $webPath . '.jpg';
                    } elseif (file_exists(public_path("icons/{$slug}.png"))) {
                        $iconPath = $webPath . '.png';
                    } else {
                        $iconPath = asset("icons/default.png");
                    }
                @endphp

                <a href="{{ route('dashboard', ['kategori' => $kategori->nama_kategori]) }}" class="flex flex-col items-center text-center group w-20">
                    <div class="w-16 h-16 rounded-full overflow-hidden border border-gray-300 bg-white flex items-center justify-center shadow-sm">
                        <img src="{{ $iconPath }}" alt="{{ $kategori->nama_kategori }}" class="object-contain w-full h-full group-hover:scale-105 transition-transform">
                    </div>
                    <span class="mt-1 text-sm text-white group-hover:text-blue-300">{{ $kategori->nama_kategori }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Daftar Produk -->
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($produkList as $produk)
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition">
                    <div class="w-full h-48 bg-gray-100 rounded mb-3 overflow-hidden flex items-center justify-center">
                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="object-cover w-full h-full" alt="Gambar Produk">
                        @else
                            <span class="text-gray-400">Tidak ada gambar</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $produk->nama_produk }}</h3>
                    <p class="text-sm text-gray-500 truncate">{{ $produk->deskripsi }}</p>
                    <div class="flex justify-between items-center mt-2 text-sm">
                        <span class="text-blue-600 font-semibold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                        <span class="text-gray-600">Stok: {{ $produk->stok }}</span>
                    </div>
                    <span class="inline-block mt-2 text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                        {{ $produk->kategori->nama_kategori ?? 'Tidak ada kategori' }}
                    </span>

                    <!-- Tombol Tambah ke Keranjang -->
                    <form action="{{ route('cart.add', $produk->id) }}" method="POST" class="mt-3">
                        @csrf
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 text-sm rounded">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">Belum ada produk.</div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function toggleTopUp() {
    const form = document.getElementById('topUpForm');
    form.classList.toggle('hidden');
}

    let walletVisible = true;

    function toggleWallet() {
        const wallet = document.getElementById('walletAmount');
        const eyeIcon = document.getElementById('eyeIcon');

        if (walletVisible) {
            wallet.dataset.amount = wallet.innerText;
            wallet.innerText = '••••••••';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.055 10.055 0 012.204-3.568M6.18 6.18a9.978 9.978 0 0111.31 0M3 3l18 18" />
            `;
        } else {
            wallet.innerText = wallet.dataset.amount;
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            `;
        }

        walletVisible = !walletVisible;
    }
</script>



@endsection
