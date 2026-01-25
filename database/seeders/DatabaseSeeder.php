<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat User Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'id_anggota' => null,
        ]);

        // Buat User Staff
        User::create([
            'username' => 'staff',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'id_anggota' => null,
        ]);

        // Buat User Staff Stock
        User::create([
            'username' => 'staffstock',
            'password' => Hash::make('password'),
            'role' => 'staff_stock',
            'id_anggota' => null,
        ]);

        // Buat Anggota
        $anggota1 = Anggota::create([
            'nama_anggota' => 'Budi Santoso',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'no_telp' => '081234567890',
            'tanggal_daftar' => now(),
            'status_anggota' => 'Aktif',
        ]);

        // Buat User untuk Anggota
        User::create([
            'username' => 'budi',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'id_anggota' => $anggota1->id_anggota,
        ]);

        $anggota2 = Anggota::create([
            'nama_anggota' => 'Siti Nurhaliza',
            'alamat' => 'Jl. Sudirman No. 456, Bandung',
            'no_telp' => '082345678901',
            'tanggal_daftar' => now(),
            'status_anggota' => 'Aktif',
        ]);

        User::create([
            'username' => 'siti',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'id_anggota' => $anggota2->id_anggota,
        ]);

        // Buat Sample Buku
        Buku::create([
            'judul_buku' => 'Laskar Pelangi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'tahun_terbit' => 2005,
            'stok' => 10,
        ]);

        Buku::create([
            'judul_buku' => 'Bumi Manusia',
            'penulis' => 'Pramoedya Ananta Toer',
            'penerbit' => 'Hasta Mitra',
            'tahun_terbit' => 1980,
            'stok' => 8,
        ]);

        Buku::create([
            'judul_buku' => 'Negeri 5 Menara',
            'penulis' => 'Ahmad Fuadi',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 2009,
            'stok' => 12,
        ]);

        Buku::create([
            'judul_buku' => 'Perahu Kertas',
            'penulis' => 'Dee Lestari',
            'penerbit' => 'Bentang Pustaka',
            'tahun_terbit' => 2009,
            'stok' => 5,
        ]);

        Buku::create([
            'judul_buku' => 'Ayat-Ayat Cinta',
            'penulis' => 'Habiburrahman El Shirazy',
            'penerbit' => 'Republika',
            'tahun_terbit' => 2004,
            'stok' => 15,
        ]);

        Buku::create([
            'judul_buku' => 'Sang Pemimpi',
            'penulis' => 'Andrea Hirata',
            'penerbit' => 'Bentang Pustaka',
            'tahun_terbit' => 2006,
            'stok' => 7,
        ]);

        Buku::create([
            'judul_buku' => 'Ronggeng Dukuh Paruk',
            'penulis' => 'Ahmad Tohari',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 1982,
            'stok' => 4,
        ]);

        Buku::create([
            'judul_buku' => 'Gadis Kretek',
            'penulis' => 'Ratih Kumala',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 2012,
            'stok' => 9,
        ]);

        Buku::create([
            'judul_buku' => 'Cantik Itu Luka',
            'penulis' => 'Eka Kurniawan',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 2002,
            'stok' => 6,
        ]);

        Buku::create([
            'judul_buku' => 'Pulang',
            'penulis' => 'Leila S. Chudori',
            'penerbit' => 'KPG',
            'tahun_terbit' => 2012,
            'stok' => 11,
        ]);
    }
}
