@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(!empty($cart) && count($cart) > 0)
        <div class="bg-white shadow rounded-lg p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Produk</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Harga</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Jumlah</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Subtotal</th>
                            <th class="px-6 py-3 text-sm font-semibold text-gray-700 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php $total = 0; @endphp
                        @foreach ($cart as $id => $item)
                            @php
                                $subtotal = $item['harga'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td class="px-6 py-4 flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $item['gambar']) }}" alt="Gambar Produk" class="w-16 h-16 object-cover rounded">
                                    <span class="text-gray-800 font-medium">{{ $item['nama_produk'] }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $item['quantity'] }}</td>
                                <td class="px-6 py-4 text-gray-800 font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-100">
                            <td colspan="3" class="px-6 py-4 text-right font-semibold text-gray-700">Total</td>
                            <td class="px-6 py-4 text-gray-900 font-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan keranjang?')">
                    @csrf
                    <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-5 py-2 rounded">
                        Kosongkan Keranjang
                    </button>
                </form>

                <a href="#" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded">
                    Checkout
                </a>
            </div>
        </div>
    @else
        <div class="bg-white p-6 rounded shadow text-center text-gray-500">
            Keranjang Anda kosong.
        </div>
    @endif
</div>
@endsection
