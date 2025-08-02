<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed user dummy tanpa duplikasi
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // ganti dengan password yang kamu inginkan
                'remember_token' => Str::random(10),
            ]
        );

        // Panggil seeder kategori
        $this->call([
            KategoriSeeder::class,
            ProdukSeeder::class
        ]);
    }
}
