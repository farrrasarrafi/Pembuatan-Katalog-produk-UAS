<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
public function index() {
    $products = Produk::all(); // sudah benar
    return view('products.index', compact('products')); // <-- ini yang diperbaiki
    
}


    public function create() {
        $categories = Kategori::all();
        return view('products.create', compact('categories'));
    }
public function store(Request $request) {
    $request->validate([
        'nama_produk' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
        'kategori_id' => 'required',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->all();
if ($request->hasFile('gambar')) {
    $file = $request->file('gambar');
    $path = $file->store('produk', 'public'); // simpan ke storage/app/public/produk
    $data['gambar'] = $path; // simpan path relatif ke database
}


    Produk::create($data);
    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

public function edit($id)
{
    $product = Produk::findOrFail($id);
    $categories = Kategori::all(); // Ambil semua kategori

    return view('products.edit', compact('product', 'categories'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'kategori_id' => 'required|exists:kategoris,id',
        'gambar' => 'nullable|image|max:2048',
    ]);

    $product = Produk::findOrFail($id);
    $product->nama_produk = $request->nama_produk;
    $product->deskripsi = $request->deskripsi;
    $product->harga = $request->harga;
    $product->stok = $request->stok;
    $product->kategori_id = $request->kategori_id;

    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar')->store('produk', 'public');
        $product->gambar = $gambar;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
}

    public function destroy(Produk $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
