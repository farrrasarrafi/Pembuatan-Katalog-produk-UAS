<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Tampilkan semua kategori.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('categories.index', compact('kategoris'));
    }

    /**
     * Tampilkan form tambah kategori.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        Kategori::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail kategori (opsional).
     */
    public function show(Kategori $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Tampilkan form edit kategori.
     */
    public function edit(Kategori $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update data kategori.
     */
    public function update(Request $request, Kategori $category)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
        ]);

        $category->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori dari database.
     */
    public function destroy(Kategori $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
