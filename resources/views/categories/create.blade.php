@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6">
    <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>

    <form method="POST" action="{{ route('categories.store') }}" class="space-y-4">
        @csrf

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input
                type="text"
                id="nama"
                name="nama"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('nama') }}"
                required
            >
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('categories.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >Simpan</button>
        </div>
    </form>
</div>
@endsection
