@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">{{ $product->name }}</h2>

    @if($product->image)
        <img src="{{ asset('storage/produk' . $product->image) }}" alt="Gambar Produk" class="w-full h-64 object-cover rounded mb-4">
    @endif

    <p class="text-gray-700 mb-2">{{ $product->description }}</p>

    <p class="text-lg font-semibold text-blue-700 mb-1">Rp {{ number_format($product->price) }}</p>

    <p class="text-sm text-gray-500 mb-1">Stok: {{ $product->stock }}</p>

    @if ($product->category)
        <p class="text-sm text-gray-600">Kategori: <span class="font-medium">{{ $product->category->nama }}</span></p>
    @endif

    <div class="mt-6">
        <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">← Kembali ke daftar produk</a>
    </div>
</div>
@endsection
