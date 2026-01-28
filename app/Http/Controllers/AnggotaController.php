<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::orderBy('id_anggota', 'desc')->paginate(10);
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'tanggal_daftar' => 'required|date',
            'status_anggota' => 'required|in:Aktif,Nonaktif',
            'username' => 'required|unique:user,username',
            'password' => 'required|min:6',
        ]);

        // Buat anggota terlebih dahulu
        $anggota = Anggota::create([
            'nama_anggota' => $validated['nama_anggota'],
            'alamat' => $validated['alamat'],
            'no_telp' => $validated['no_telp'],
            'tanggal_daftar' => $validated['tanggal_daftar'],
            'status_anggota' => $validated['status_anggota'],
        ]);

        // Buat user untuk anggota
        User::create([
            'name' => $validated['nama_anggota'],
            'email' => $validated['username'] . '@perpustakaan.com',
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'anggota',
            'id_anggota' => $anggota->id_anggota,
        ]);

        return redirect(roleRoute('anggota.index'))->with('success', 'Anggota berhasil ditambahkan');
    }

    public function show(Anggota $anggotum)
    {
        return view('anggota.show', compact('anggotum'));
    }

    public function edit(Anggota $anggotum)
    {
        return view('anggota.edit', compact('anggotum'));
    }

    public function update(Request $request, Anggota $anggotum)
    {
        $validated = $request->validate([
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'tanggal_daftar' => 'required|date',
            'status_anggota' => 'required|in:Aktif,Nonaktif',
        ]);

        $anggotum->update($validated);

        // Update nama di user jika ada
        if ($anggotum->user) {
            $anggotum->user->update(['name' => $validated['nama_anggota']]);
        }

        return redirect(roleRoute('anggota.index'))->with('success', 'Anggota berhasil diupdate');
    }

    public function destroy(Anggota $anggotum)
    {
        // Hapus user jika ada
        if ($anggotum->user) {
            $anggotum->user->delete();
        }

        $anggotum->delete();
        return redirect(roleRoute('anggota.index'))->with('success', 'Anggota berhasil dihapus');
    }
}
