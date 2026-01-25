<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    public $timestamps = false;

    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok'
    ];

    // Relasi: buku bisa di banyak detail peminjaman
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_buku', 'id_buku');
    }

    // Relasi: buku bisa di banyak booking
    public function booking()
    {
        return $this->hasMany(Booking::class, 'id_buku', 'id_buku');
    }

    // Relasi many-to-many dengan peminjaman via detail_peminjaman
    public function peminjaman()
    {
        return $this->belongsToMany(Peminjaman::class, 'detail_peminjaman', 'id_buku', 'id_peminjaman')
            ->withPivot('jumlah');
    }
}
