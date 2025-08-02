@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-4">Detail Kategori</h2>

    <div class="bg-white shadow p-4 rounded border">
        <p class="text-gray-700"><span class="font-semibold">Nama:</span> {{ $category->nama }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">← Kembali ke daftar</a>
    </div>
</div>
@endsection
