@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <div class="bg-white shadow px-6 py-3 rounded-md border border-gray-200">
    <h1 class="text-xl font-semibold text-gray-800">Daftar Produk</h1>
</div>

        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Produk</a>
    </div>

    @if($products->isEmpty())
        <div class="text-center text-gray-500 py-10">
            Belum ada produk yang tersedia.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded shadow p-4">
                    @if($product->gambar)
    <img src="{{ asset('storage/' . $product->gambar) }}" class="..." />
@endif
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->nama_produk }}</h3>
                    <p class="text-gray-700 text-sm mb-2">{{ $product->deskripsi }}</p>
                    <p class="text-gray-600">Rp {{ number_format($product->harga) }}</p>
                    <p class="text-sm text-gray-500">Stok: {{ $product->stok }}</p>
                    <p class="text-sm text-gray-500">Kategori: {{ $product->kategori->nama_kategori ?? 'Tidak Ada' }}</p>

                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="text-white bg-yellow-500 px-3 py-1 rounded">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-white bg-red-600 px-3 py-1 rounded">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach


        </div>
    @endif
</div>
@endsection
