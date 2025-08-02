<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = ['Elektronik', 'Pakaian', 'Sepatu', 'Makanan', 'Minuman', 'Aksesoris','Otomotif', 'Hobi & Koleksi', 'Kesehatan','Anak-anak','Peralatan Rumah'];

        foreach ($kategoris as $kategori) {
            $slug = Str::slug($kategori);

            Kategori::updateOrCreate(
                ['slug' => $slug],
                [
                    'nama_kategori' => $kategori,
                    'slug' => $slug
                ]
            );
        }
    }
}
