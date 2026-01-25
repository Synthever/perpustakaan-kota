<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Anggota;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:50|unique:user,username',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'username.min' => 'Username minimal 3 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        // Buat data anggota dengan status pending (profil belum lengkap)
        $anggota = Anggota::create([
            'nama_anggota' => null,
            'alamat' => null,
            'no_telp' => null,
            'tanggal_daftar' => now(),
            'status_anggota' => 'Pending'
        ]);

        // Buat user dengan role anggota
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
            'id_anggota' => $anggota->id_anggota
        ]);

        // Auto login setelah register
        Auth::login($user);

        return redirect()->route('profile.complete')
            ->with('success', 'Pendaftaran berhasil! Silakan lengkapi profil Anda.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    private function redirectBasedOnRole()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isStaff()) {
            return redirect()->route('staff.dashboard');
        } elseif ($user->isStaffStock()) {
            return redirect()->route('staff-stock.dashboard');
        } else {
            // Cek apakah profil anggota sudah lengkap
            if ($user->anggota && $user->anggota->status_anggota === 'Pending') {
                return redirect()->route('profile.complete');
            }
            return redirect()->route('anggota.dashboard');
        }
    }

    public function showCompleteProfile()
    {
        $user = Auth::user();
        $anggota = $user->anggota;
        
        return view('profile.complete', compact('anggota'));
    }

    public function storeCompleteProfile(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:100',
        ], [
            'nama_anggota.required' => 'Nama lengkap wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_telp.required' => 'No. telepon wajib diisi',
            'pekerjaan.required' => 'Pekerjaan wajib diisi',
        ]);

        $user = Auth::user();
        $anggota = $user->anggota;

        $anggota->update([
            'nama_anggota' => $request->nama_anggota,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'pekerjaan' => $request->pekerjaan,
            'status_anggota' => 'Aktif'
        ]);

        return redirect()->route('anggota.dashboard')
            ->with('success', 'Profil berhasil dilengkapi! Anda sekarang dapat melakukan peminjaman dan booking buku.');
    }
}
