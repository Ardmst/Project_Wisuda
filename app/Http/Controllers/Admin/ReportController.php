<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman dashboard laporan (dengan Statistik & Pagination)
     */
    public function index(Request $request)
    {
        // 1. Query Dasar
        $query = User::where('role', 'mahasiswa');

        // 2. Filter Prodi
        if ($request->filled('prodi')) {
            $query->where('major', $request->prodi);
        }

        // 3. Hitung Statistik (Pakai clone biar query utama gak rusak)
        $totalSiswa = (clone $query)->count();
        $totalLulus = (clone $query)->where('status', 'lulus')->count();
        $totalAktif = (clone $query)->where('status', 'aktif')->count();

        // 4. Ambil Data untuk Tabel (Pagination 10)
        $students = $query->latest()->paginate(10);

        // 5. Ambil Daftar Prodi untuk Dropdown
        $prodis = User::where('role', 'mahasiswa')
                    ->select('major')
                    ->distinct()
                    ->pluck('major');

        return view('admin.reports.index', compact(
            'students', 'prodis', 'totalSiswa', 'totalLulus', 'totalAktif'
        ));
    }

    /**
     * Menampilkan halaman KHUSUS CETAK (Tanpa Pagination)
     * Ini fungsi baru yang wajib ada!
     */
    public function print(Request $request)
    {
        // 1. Query Dasar (Sama persis dengan index)
        $query = User::where('role', 'mahasiswa');

        // 2. Filter Prodi (Harus sama biar hasil cetak sesuai filter)
        if ($request->filled('prodi')) {
            $query->where('major', $request->prodi);
        }

        // 3. AMBIL SEMUA DATA (Pakai get(), bukan paginate)
        // Kita butuh semua data tercetak, bukan cuma 10 biji.
        $students = $query->latest()->get(); 

        // 4. Lempar ke view khusus cetak
        return view('admin.reports.print', compact('students'));
    }
}