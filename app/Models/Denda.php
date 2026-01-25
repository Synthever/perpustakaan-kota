<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    use HasFactory;

    protected $table = 'denda';
    protected $primaryKey = 'id_denda';
    public $timestamps = false;

    protected $fillable = [
        'jumlah_denda',
        'status_pembayaran',
        'id_peminjaman'
    ];

    protected $casts = [
        'jumlah_denda' => 'decimal:2',
    ];

    // Relasi: denda belongs to peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
}
