<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GraduationRegistration; // Import Model Pendaftaran
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Statistik Real-Time
        $pendingCount = GraduationRegistration::where('status', 'pending')->count();
        $verifiedCount = GraduationRegistration::where('status', 'verified')->count();
        $totalUser = User::where('role', 'mahasiswa')->count();

        // 2. Kirim data ke View
        return view('admin.dashboard', compact('pendingCount', 'verifiedCount', 'totalUser'));
    }
}