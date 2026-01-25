<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $query = Peminjaman::with(['anggota', 'detailPeminjaman.buku']);
        
        // Jika role anggota, hanya tampilkan peminjaman miliknya sendiri
        if (auth()->user()->role === 'anggota') {
            $query->where('id_anggota', auth()->user()->id_anggota);
        }
        
        $peminjaman = $query->orderBy('id_peminjaman', 'desc')->paginate(10);
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $anggota = Anggota::where('status_anggota', 'Aktif')->get();
        $buku = Buku::where('stok', '>', 0)->get();
        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_anggota' => 'required|exists:anggota,id_anggota',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after:tanggal_pinjam',
            'buku' => 'required|array|min:1',
            'buku.*.id_buku' => 'required|exists:buku,id_buku',
            'buku.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Cek stok buku
            foreach ($validated['buku'] as $item) {
                $buku = Buku::find($item['id_buku']);
                if ($buku->stok < $item['jumlah']) {
                    return back()->withErrors(['error' => "Stok buku {$buku->judul_buku} tidak mencukupi"])->withInput();
                }
            }

            // Buat peminjaman
            $peminjaman = Peminjaman::create([
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_jatuh_tempo' => $validated['tanggal_jatuh_tempo'],

                'id_anggota' => $validated['id_anggota'],
            ]);

            // Buat detail peminjaman dan kurangi stok
            foreach ($validated['buku'] as $item) {
                DetailPeminjaman::create([
                    'id_peminjaman' => $peminjaman->id_peminjaman,
                    'id_buku' => $item['id_buku'],
                    'jumlah' => $item['jumlah'],
                ]);

                // Kurangi stok buku
                $buku = Buku::find($item['id_buku']);
                $buku->decrement('stok', $item['jumlah']);
            }

            DB::commit();
            return redirect(roleRoute('peminjaman.index'))->with('success', 'Peminjaman berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['anggota', 'detailPeminjaman.buku', 'denda']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    public function pengembalian(Peminjaman $peminjaman)
    {
        return view('peminjaman.pengembalian', compact('peminjaman'));
    }

    public function prosesKembali(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'tanggal_kembali' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            // Update tanggal kembali peminjaman
            $peminjaman->update([
                'tanggal_kembali' => $tanggalKembali,
            ]);

            // Kembalikan stok buku
            foreach ($peminjaman->detailPeminjaman as $detail) {
                $detail->buku->increment('stok', $detail->jumlah);
            }

            // Cek keterlambatan dan hitung denda
            $tanggalKembali = Carbon::parse($validated['tanggal_kembali']);
            $tanggalJatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo);
            
            if ($tanggalKembali->gt($tanggalJatuhTempo)) {
                $hariTerlambat = $tanggalKembali->diffInDays($tanggalJatuhTempo);
                $jumlahDenda = $hariTerlambat * 1000; // Rp 1.000 per hari

                Denda::create([
                    'jumlah_denda' => $jumlahDenda,
                    'status_pembayaran' => 'Belum Dibayar',
                    'id_peminjaman' => $peminjaman->id_peminjaman,
                ]);
            }

            DB::commit();
            return redirect(roleRoute('peminjaman.index'))->with('success', 'Pengembalian berhasil diproses');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect(roleRoute('peminjaman.index'))->with('success', 'Data peminjaman berhasil dihapus');
    }
}
