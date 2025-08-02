<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    protected $fillable = ['nama_kategori', 'slug'];

    protected $table = 'kategoris'; // <- Ini penting!
// Di app/Models/Kategori.php
public function produks()
{
    return $this->hasMany(Produk::class, 'kategori_id');
}

}

