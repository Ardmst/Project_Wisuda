<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGraduationRequest; 
use App\Models\GraduationRegistration; 
use App\Models\User; // Tambahkan ini untuk filter Prodi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class GraduationController extends Controller
{
    /**
     * Tampilkan Form Pendaftaran
     */
    public function create()
    {
        $user = Auth::user();

        // Cek apakah user sudah mendaftar
        $existingRegistration = GraduationRegistration::where('user_id', $user->id)->first();
        if ($existingRegistration) {
            return redirect()->route('dashboard')
                ->with('info', 'Anda sudah terdaftar. Silakan pantau status verifikasi Anda.');
        }

        return view('graduation.create');
    }

    /**
     * Simpan Data Pendaftaran
     */
    public function store(StoreGraduationRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::user();

        GraduationRegistration::create([
            'user_id' => $user->id,
            'parent_name'  => $validatedData['parent_name'],
            'toga_size'    => $validatedData['toga_size'],
            'ipk'          => $validatedData['ipk'],
            'ips'          => $validatedData['ips'],
            'thesis_title' => $validatedData['thesis_title'],
            
            // Data Dummy (Wajib ada biar gak error database)
            'nik'     => $user->nik ?? '1234567890123456', 
            'phone'   => $user->phone ?? '08123456789',
            'address' => $user->address ?? 'Alamat Menyusul',
            
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran berhasil dikirim! Menunggu verifikasi admin.');
    }

    /**
     * CETAK BIODATA
     */
    public function printBiodata()
    {
        $user = Auth::user();
        $data = GraduationRegistration::where('user_id', $user->id)->first();

        if (!$data) {
            return redirect()->route('graduation.create')
                ->with('error', 'Isi formulir pendaftaran dulu sebelum mencetak biodata.');
        }

        return view('graduation.print.biodata', compact('user', 'data'));
    }

    /**
     * CETAK DRAFT IJAZAH
     */
    public function printDraft()
    {
        $user = Auth::user();
        $data = GraduationRegistration::where('user_id', $user->id)->first();

        if (!$data) {
            return redirect()->route('graduation.create')
                ->with('error', 'Silakan daftar wisuda terlebih dahulu.');
        }

        return view('graduation.print.draft', compact('user', 'data'));
    }

    /**
     * FITUR PANTAU: DAFTAR PESERTA (BARU)
     */
    public function listPeserta(Request $request)
    {
        // 1. Mulai Query (Hanya ambil user yang role-nya MAHASISWA)
        $query = GraduationRegistration::with('user')
            ->whereHas('user', function($q) {
                $q->where('role', 'mahasiswa'); // <-- FILTER PENTING INI
            });

        // 2. Filter Prodi
        if ($request->filled('prodi')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('major', $request->prodi);
            });
        }

        // 3. Filter Angkatan
        if ($request->filled('angkatan')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('cohort', 'like', '%' . $request->angkatan . '%');
            });
        }

        // 4. Search Nama/NIM
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('nim', 'like', "%$search%");
            });
        }

        // 5. Ambil Data
        $participants = $query->latest()->paginate(10);

        // 6. Data Prodi untuk Dropdown (KECUALIKAN ADMIN & YANG KOSONG)
        $prodis = \App\Models\User::where('role', 'mahasiswa') // <-- Cuma ambil prodi punya mahasiswa
                    ->whereNotNull('major')
                    ->where('major', '!=', '')
                    ->distinct()
                    ->pluck('major');

        return view('graduation.list', compact('participants', 'prodis'));
    }


    /**
     * BUKU KENANGAN (HANYA UNTUK YANG SUDAH VERIFIED)
     */
    public function yearbook()
    {
        $user = Auth::user();
        
        // 1. Cek Status User Sendiri
        $myReg = GraduationRegistration::where('user_id', $user->id)->first();

        // Kalau belum daftar atau status bukan verified, tendang balik
        if (!$myReg || $myReg->status != 'verified') {
            return redirect()->route('dashboard')
                ->with('error', 'Maaf, Buku Kenangan hanya dapat diakses oleh calon wisudawan yang sudah diverifikasi.');
        }

        // 2. Ambil Semua Data Wisudawan yang 'Verified'
        $graduates = GraduationRegistration::with('user')
                        ->where('status', 'verified')
                        ->latest()
                        ->paginate(9); // Tampilkan 9 orang per halaman

        return view('graduation.yearbook', compact('graduates'));
    }
}

