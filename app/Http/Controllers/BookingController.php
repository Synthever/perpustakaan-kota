<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAnggota()) {
            // Anggota hanya lihat bookingnya sendiri
            $booking = Booking::with(['buku'])
                ->where('id_anggota', $user->id_anggota)
                ->orderBy('id_booking', 'desc')
                ->paginate(10);
        } else {
            // Admin & staff lihat semua
            $booking = Booking::with(['anggota', 'buku'])
                ->orderBy('id_booking', 'desc')
                ->paginate(10);
        }
        
        return view('booking.index', compact('booking'));
    }

    public function create()
    {
        $buku = Buku::all();
        return view('booking.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
            'tanggal_booking' => 'required|date',
        ]);

        $user = Auth::user();

        if (!$user->isAnggota()) {
            return back()->withErrors(['error' => 'Hanya anggota yang bisa melakukan booking']);
        }

        Booking::create([
            'tanggal_booking' => $validated['tanggal_booking'],
            'status_booking' => 'Menunggu',
            'id_anggota' => $user->id_anggota,
            'id_buku' => $validated['id_buku'],
        ]);

        return redirect(roleRoute('booking.index'))->with('success', 'Booking berhasil dibuat');
    }

    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status_booking' => 'required|in:Menunggu,Disetujui,Ditolak',
        ]);

        $booking->update($validated);

        return redirect(roleRoute('booking.index'))->with('success', 'Status booking berhasil diupdate');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect(roleRoute('booking.index'))->with('success', 'Booking berhasil dihapus');
    }
}
