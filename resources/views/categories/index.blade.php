@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Kategori</a>
    </div>

    <table class="min-w-full bg-white border rounded shadow-sm text-sm">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4 border-b">#</th>
                <th class="py-2 px-4 border-b">Nama Kategori</th>
                <th class="py-2 px-4 border-b text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $index => $category)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $category->nama }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <a href="{{ route('categories.edit', $category->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 mr-2">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">Belum ada kategori</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
