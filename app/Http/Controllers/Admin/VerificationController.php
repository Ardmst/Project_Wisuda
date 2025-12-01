<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GraduationRegistration; // <--- PENTING: Sesuai nama tabel di DB kamu

class VerificationController extends Controller
{
    /**
     * Tampilkan dashboard Admin.
     */
    public function dashboard()
    {
        // Hitung data yang statusnya 'pending'
        $pendingCount = GraduationRegistration::where('status', 'pending')->count();

        return view('admin.dashboard', compact('pendingCount'));
    }

    /**
     * READ: Tampilkan daftar pendaftaran (Index).
     */
    public function index()
    {
        // Ambil data pending, urutkan terbaru, paginate 10
        // Kita pakai variable 'registrations' biar rapi
        $registrations = GraduationRegistration::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        // Kirim ke view (pastikan di View kamu looping variable $registrations)
        return view('admin.verification.index', compact('registrations'));
    }

    /**
     * UPDATE: Verifikasi Mahasiswa (Method PATCH).
     */
    public function updateStatus(Request $request, $id)
    {
        // 1. Cari data berdasarkan ID
        $item = GraduationRegistration::findOrFail($id); 

        // 2. Update kolom status jadi 'verified'
        $item->update([
            'status' => 'verified' 
        ]);

        // 3. Kembali dengan pesan sukses
        // (Opsional: ambil nama user buat pesan lebih personal)
        $nama = $item->user->name ?? 'Mahasiswa';
        return redirect()->back()->with('success', "Data $nama berhasil diverifikasi!");
    }

    /**
     * DELETE: Tolak Pendaftaran (Method DELETE).
     */
    public function destroy($id)
    {
        // 1. Cari data
        $item = GraduationRegistration::findOrFail($id);
        
        // 2. Hapus data dari database (Hard Delete)
        $item->delete();

        return redirect()->back()->with('success', 'Pendaftaran berhasil ditolak dan dihapus.');
    }
}