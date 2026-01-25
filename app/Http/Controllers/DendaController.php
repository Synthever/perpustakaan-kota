<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAnggota()) {
            // Anggota hanya lihat dendanya sendiri
            $denda = Denda::with(['peminjaman.anggota'])
                ->whereHas('peminjaman', function($query) use ($user) {
                    $query->where('id_anggota', $user->id_anggota);
                })
                ->orderBy('id_denda', 'desc')
                ->paginate(10);
        } else {
            // Admin & staff lihat semua
            $denda = Denda::with(['peminjaman.anggota'])
                ->orderBy('id_denda', 'desc')
                ->paginate(10);
        }
        
        return view('denda.index', compact('denda'));
    }

    public function show(Denda $denda)
    {
        $denda->load(['peminjaman.anggota', 'peminjaman.detailPeminjaman.buku']);
        return view('denda.show', compact('denda'));
    }

    public function bayar(Denda $denda)
    {
        if ($denda->status_pembayaran === 'Dibayar') {
            return back()->withErrors(['error' => 'Denda sudah dibayar']);
        }

        $denda->update(['status_pembayaran' => 'Dibayar']);

        return redirect(roleRoute('denda.index'))->with('success', 'Pembayaran denda berhasil');
    }

    public function destroy(Denda $denda)
    {
        // Hanya bisa hapus jika sudah dibayar
        if ($denda->status_pembayaran !== 'Dibayar') {
            return back()->withErrors(['error' => 'Hanya denda yang sudah dibayar yang bisa dihapus']);
        }

        $denda->delete();
        return redirect(roleRoute('denda.index'))->with('success', 'Data denda berhasil dihapus');
    }
}
