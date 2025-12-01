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
        // 1. Cek dulu user sudah login atau belum
        // Kalau belum login, lempar balik ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek apakah kolom 'faculty' isinya 'admin'
        // Sesuai request kamu, pembedanya ada di kolom faculty
        if (Auth::user()->faculty !== 'admin') {
            // Kalau bukan admin (misal mahasiswa), kasih error 403 Forbidden
            abort(403, 'Akses Ditolak. Halaman ini khusus Admin.');
        }

        // Kalau lolos dua pengecekan di atas, silakan lanjut
        return $next($request);
    }
}