<?php

if (!function_exists('roleRoute')) {
    /**
     * Generate route berdasarkan role user yang sedang login
     * 
     * @param string $name Nama route tanpa prefix (contoh: 'anggota.index')
     * @param mixed $parameters Parameter untuk route
     * @return string URL route yang sudah di-generate
     */
    function roleRoute($name, $parameters = []) {
        $user = auth()->user();
        
        if (!$user) {
            return route($name, $parameters);
        }
        
        $prefix = match($user->role) {
            'admin' => 'admin.',
            'staff' => 'staff.',
            'staff_stock' => 'staff-stock.',
            'anggota' => 'anggota.',
            default => ''
        };
        
        return route($prefix . $name, $parameters);
    }
}
