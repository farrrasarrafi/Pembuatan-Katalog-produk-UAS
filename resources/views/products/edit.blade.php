@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-6 sm:px-10 font-['Inter']">
    <h2 class="text-4xl font-bold text-white mb-10 tracking-tight leading-tight">
        <span class="inline-block bg-gradient-to-r from-green-400 to-blue-500 text-transparent bg-clip-text drop-shadow-md">✏️ Edit Produk</span>
    </h2>

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="bg-[#0f172a] p-8 sm:p-10 rounded-3xl shadow-xl border border-gray-800 space-y-8 transition-all duration-300">
        @csrf
        @method('PUT')

        {{-- NAMA PRODUK --}}
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2"> Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}"
                class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            @error('nama_produk') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- DESKRIPSI --}}
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2"> Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">{{ old('deskripsi', $product->deskripsi) }}</textarea>
            @error('deskripsi') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- HARGA & STOK --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2"> Harga (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga', $product->harga) }}"
                    class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition">
                @error('harga') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2"> Stok Tersedia</label>
                <input type="number" name="stok" value="{{ old('stok', $product->stok) }}"
                    class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition">
                @error('stok') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- KATEGORI --}}
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2">Kategori</label>
            <select name="kategori_id"
                class="w-full px-5 py-3 rounded-xl bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->kategori_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- GAMBAR --}}
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2">Upload Gambar</label>
            <input type="file" name="gambar"
                class="block w-full text-sm text-white bg-gray-800 rounded-xl border border-gray-700 cursor-pointer file:bg-indigo-600 file:border-0 file:px-5 file:py-2 file:rounded-md file:text-white hover:file:bg-indigo-700 transition">
            <p class="text-xs text-gray-400 mt-1">Max 2MB. Format: JPG, PNG.</p>
            @error('gambar') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror

            @if ($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk" class="w-32 mt-4 rounded-lg border border-gray-600">
            @endif
        </div>

        {{-- SUBMIT --}}
        <div>
            <button type="submit"
                class="w-full py-3 rounded-xl bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 text-white font-bold text-lg shadow-md transition-all">
                Update Produk
            </button>
        </div>
    </form>
</div>
@endsection
