<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua kategori
        $kategoris = Kategori::all();

        // Jika belum ada kategori, skip seeding
        if ($kategoris->isEmpty()) {
            $this->command->warn('Tidak ada kategori ditemukan. Jalankan KategoriSeeder terlebih dahulu.');
            return;
        }

        // Seed produk untuk setiap kategori
        foreach ($kategoris as $kategori) {
            Produk::create([
                'nama_produk' => 'Produk ' . $kategori->nama_kategori,
                'deskripsi' => 'Deskripsi untuk produk ' . $kategori->nama_kategori,
                'harga' => rand(10000, 500000),
                'stok' => rand(10, 100),
                'kategori_id' => $kategori->id,
                'gambar' => null, // atau 'default.jpg' jika kamu pakai gambar default
            ]);
        }
    }
}
