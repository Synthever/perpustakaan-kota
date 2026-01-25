<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        // Hanya cek untuk user dengan role anggota
        if ($user && $user->role === 'anggota') {
            // Jika anggota belum ada atau status masih Pending
            if (!$user->anggota || $user->anggota->status_anggota === 'Pending') {
                return redirect()->route('profile.complete')
                    ->with('warning', 'Anda harus melengkapi profil terlebih dahulu untuk mengakses fitur ini.');
            }
        }
        
        return $next($request);
    }
}
