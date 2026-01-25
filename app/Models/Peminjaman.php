<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'id_anggota'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_jatuh_tempo' => 'date',
    ];

    // Relasi: peminjaman belongs to anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

    // Relasi: peminjaman bisa punya banyak detail peminjaman
    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }

    // Relasi: peminjaman bisa punya 1 denda
    public function denda()
    {
        return $this->hasOne(Denda::class, 'id_peminjaman', 'id_peminjaman');
    }

    // Relasi many-to-many dengan buku via detail_peminjaman
    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'detail_peminjaman', 'id_peminjaman', 'id_buku')
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}
