<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $primaryKey = 'id_booking';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_booking',
        'status_booking',
        'id_anggota',
        'id_buku'
    ];

    protected $casts = [
        'tanggal_booking' => 'date',
    ];

    // Relasi: booking belongs to anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

    // Relasi: booking belongs to buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }
}
