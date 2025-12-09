<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// RUTE "PINTAR" (REDIRECT DASHBOARD)
// ==========================================
Route::get('/dashboard', function () {
    // Cek role user: Admin lempar ke admin, Mahasiswa tetap di sini
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================
// RUTE USER & MAHASISWA (AUTH)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // --- Profil User ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Menu Mahasiswa ---
    Route::get('/manual-book', function () {
        return view('manual-book');
    })->name('manual.book');

   // ... di dalam middleware 'auth' ...

// ... di dalam middleware 'auth' ...
// ... rute cetak yang lain ...

// ... rute pantau ...
    Route::get('/graduation/list', [GraduationController::class, 'listPeserta'])->name('graduation.list');

// --- TAMBAHKAN INI ---
    Route::get('/graduation/yearbook', [GraduationController::class, 'yearbook'])->name('graduation.yearbook');
// ---------------------

    // Rute Pendaftaran (Sudah ada)
    Route::get('/graduation/register', [GraduationController::class, 'create'])->name('graduation.create');
    Route::post('/graduation/register', [GraduationController::class, 'store'])->name('graduation.store');

    // --- TAMBAHKAN INI (JANGAN SAMPAI LEWAT) ---
    Route::get('/graduation/print/biodata', [GraduationController::class, 'printBiodata'])->name('graduation.print.biodata');
    Route::get('/graduation/print/draft', [GraduationController::class, 'printDraft'])->name('graduation.print.draft');

    // Rute Buku Panduan
    Route::get('/manual-book', function () {
    return view('manual-book');
})->name('manual.book');
    // --------------------------------------------
    // ... rute cetak yang tadi ...


// ...
});


// ==========================================
// RUTE KHUSUS ADMIN (FULL ACCESS)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Dashboard Admin
    Route::get('/dashboard', [VerificationController::class, 'dashboard'])->name('dashboard');
    
    // 2. Verifikasi Pendaftaran
    Route::controller(VerificationController::class)
        ->prefix('verification')
        ->name('verification.')
        ->group(function () {
            Route::get('/', 'index')->name('index'); 
            Route::patch('/update/{id}', 'updateStatus')->name('update'); 
            Route::delete('/delete/{id}', 'destroy')->name('destroy'); 
        });
    
    // 3. Kelola Pengumuman
    Route::controller(AnnouncementController::class)
        ->prefix('announcements')
        ->name('announcements.')
        ->group(function () {
            Route::get('/', 'index')->name('index');    // Lihat Data
            Route::post('/', 'store')->name('store');   // Simpan Baru
            Route::delete('/{id}', 'destroy')->name('destroy'); // Hapus
        });

    // 4. Laporan & Filter (SUDAH DIPERBAIKI)
    Route::controller(ReportController::class)
        ->prefix('reports')
        ->name('reports.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/print', 'print')->name('print'); // <-- TAMBAHAN BARU
    });

}); 

require __DIR__.'/auth.php';