<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Booking;
use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [
            'total_anggota' => Anggota::count(),
            'total_buku' => Buku::count(),
            'total_peminjaman' => Peminjaman::count(),
            'total_denda_belum_dibayar' => Denda::where('status_pembayaran', 'Belum Dibayar')->sum('jumlah_denda'),
        ];
        return view('dashboard.admin', $data);
    }

    public function staff()
    {
        $data = [
            'total_peminjaman' => Peminjaman::count(),
            'peminjaman_terbaru' => Peminjaman::with(['anggota'])->orderBy('id_peminjaman', 'desc')->take(5)->get(),
            'total_denda' => Denda::where('status_pembayaran', 'Belum Dibayar')->count(),
        ];
        return view('dashboard.staff', $data);
    }

    public function staffStock()
    {
        $data = [
            'total_buku' => Buku::count(),
            'buku_stok_rendah' => Buku::where('stok', '<', 5)->get(),
        ];
        return view('dashboard.staff_stock', $data);
    }

    public function anggota()
    {
        $user = Auth::user();
        $data = [
            'peminjaman_aktif' => Peminjaman::where('id_anggota', $user->id_anggota)
                ->with(['detailPeminjaman.buku'])
                ->get(),
            'booking' => Booking::where('id_anggota', $user->id_anggota)
                ->where('status_booking', 'Menunggu')
                ->with(['buku'])
                ->get(),
            'denda' => Denda::whereHas('peminjaman', function($query) use ($user) {
                    $query->where('id_anggota', $user->id_anggota);
                })
                ->where('status_pembayaran', 'Belum Dibayar')
                ->with(['peminjaman'])
                ->get(),
        ];
        return view('dashboard.anggota', $data);
    }
}
