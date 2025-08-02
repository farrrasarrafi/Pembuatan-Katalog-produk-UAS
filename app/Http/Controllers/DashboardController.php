<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
{
    $this->middleware('auth');
}

public function index(Request $request)
{
    $user = auth('web')->user();
    $totalProduk = Produk::count();
    $totalKategori = Kategori::count();
    $kategoriList = Kategori::all(); // untuk ditampilkan sebagai ikon
    $iconMap = [
    'Minuman' => 'minuman.jpg',
    'Makanan' => 'makanan.jpg',
    'Sepatu' => 'sepatu.jpg',
    'Pakaian' => 'pakaian.png',
    'Aksesoris' => 'aksesoris.jpg', 
    'Elektronik' => 'elektronik.png',
    'Otomotif' => 'otomotif.png',
    'Hobi & Koleksi' => 'hobi-koleksi.jpg', 
    'Kesehatan' => 'kesehatan.png',
    'Anak-anak' => 'anak-anak.jpg', 
    'Peralatan Rumah' => 'peralatan-rumah.jpg', 
];


    $produkQuery = Produk::with('kategori');

        if ($request->filled('search')) {
        $produkQuery->where(function ($query) use ($request) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->has('sort')) {
        switch ($request->sort) {
            case 'termurah':
                $produkQuery->orderBy('harga', 'asc');
                break;
            case 'termahal':
                $produkQuery->orderBy('harga', 'desc');
                break;
            case 'terbaru':
                $produkQuery->orderBy('created_at', 'desc');
                break;
            default:
                $produkQuery->latest();
        }
    } else {
        $produkQuery->latest();
    }

    if ($request->filled('kategori')) {
    $produkQuery->whereHas('kategori', function ($query) use ($request) {
        $query->where('nama_kategori', $request->kategori);
    });
}


    $produkList = $produkQuery->get();
    
     return view('dashboard', compact('totalProduk', 'totalKategori', 'produkList', 'kategoriList', 'iconMap','user'));

}
    
public function topUpWallet(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1000',
    ]);

    /** @var \App\Models\User $user */
    $user = Auth::user();
    $user->wallet += $request->amount;
    $user->save();

    return redirect()->route('dashboard')->with('success', 'Top up berhasil!');
}


}
