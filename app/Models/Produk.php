<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
protected $fillable = [
    'nama_produk',
    'deskripsi',
    'harga',
    'stok',
    'kategori_id',
    'gambar',
];

public function kategori()
{
    return $this->belongsTo(Kategori::class, 'kategori_id');
}

}
