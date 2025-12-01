<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGraduationRequest; // <-- 1. Import penjaga gerbang
use App\Models\GraduationRegistration;      // <-- 2. Import model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;          // <-- 3. Import untuk dapatkan user

class GraduationController extends Controller
{
    /**
     * Menampilkan form pendaftaran wisuda.
     */
    public function create()
    {
        $user = Auth::user();

        // 4. LOGIKA BARU: Cek apakah user sudah mendaftar
        $existingRegistration = GraduationRegistration::where('user_id', $user->id)->first();
        if ($existingRegistration) {
            // Jika sudah terdaftar, mental balik dengan pesan 'info'
            return redirect()->route('dashboard')
                ->with('info', 'Anda sudah terdaftar. Silakan pantau status pendaftaran Anda.');
        }

        // 5. LOGIKA LAMA: Cek semester
        if ($user->semester < 7) {
            // Jika semester kurang, mental balik dengan pesan 'error'
            return redirect()->route('dashboard')
                ->with('error', 'Pendaftaran wisuda hanya untuk mahasiswa semester 7 ke atas.');
        }

        // 6. Jika lolos semua, tampilkan form
        return view('graduation.create');
    }

    /**
     * Menyimpan data pendaftaran baru dari form.
     */
    public function store(StoreGraduationRequest $request) // <-- 7. Pakai penjaga gerbang
    {
        // 8. Ambil data yang sudah divalidasi oleh StoreGraduationRequest
        $validatedData = $request->validated();

        // 9. Simpan data ke database
        GraduationRegistration::create([
            'user_id' => Auth::id(), // Set ID user yang sedang login
            'parent_name' => $validatedData['parent_name'],
            'toga_size' => $validatedData['toga_size'],
            'ipk' => $validatedData['ipk'],
            'ips' => $validatedData['ips'],
            'status' => 'pending', // Set status awal pendaftaran
        ]);

        // 10. Mental balik ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran wisuda berhasil diajukan. Status pendaftaran Anda: Pending.');
    }
}

