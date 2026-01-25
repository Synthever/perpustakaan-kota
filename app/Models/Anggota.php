<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    public $timestamps = false;

    protected $fillable = [
        'nama_anggota',
        'alamat',
        'no_telp',
        'pekerjaan',
        'tanggal_daftar',
        'status_anggota'
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
    ];

    // Relasi: 1 anggota bisa punya 1 user
    public function user()
    {
        return $this->hasOne(User::class, 'id_anggota', 'id_anggota');
    }

    // Relasi: 1 anggota bisa punya banyak peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota', 'id_anggota');
    }

    // Relasi: 1 anggota bisa punya banyak booking
    public function booking()
    {
        return $this->hasMany(Booking::class, 'id_anggota', 'id_anggota');
    }
}
