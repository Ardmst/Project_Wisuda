<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Tambahan wajib buat cek user login

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // 1. Cek apakah user sudah login?
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // 2. Cek Role User (DEBUG)
    // Kalau role bukan 'admin', kita tendang
    if (auth()->user()->role !== 'admin') {
        
        // UNCOMMENT BARIS DI BAWAH INI KALAU MAU LIHAT DIA KBACANYA APA:
        // dd('Role kamu terbaca sebagai: ' . auth()->user()->role);
        
        abort(403, 'AKSES DITOLAK. HALAMAN INI KHUSUS ADMIN.');
    }

    return $next($request);
}
}