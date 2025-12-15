<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- REGULAR CONTROLLERS ---
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GraduationController;

// --- ADMIN CONTROLLERS ---
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\GraduationPeriodController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// 1. RUTE DASHBOARD "PINTAR" (REDIRECTOR)
// ==========================================
Route::get('/dashboard', function () {
    // Jika Admin, lempar ke Dashboard Admin
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    // Jika Mahasiswa, tampilkan Dashboard Mahasiswa
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================
// 2. RUTE MAHASISWA & UMUM (AUTH)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- Profile User ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- Grup Fitur Wisuda ---
    // Prefix URL: /graduation/... | Prefix Name: graduation.
    Route::prefix('graduation')->name('graduation.')->controller(GraduationController::class)->group(function () {
        
        // Pendaftaran
        Route::get('/register', 'create')->name('create');
        Route::post('/register', 'store')->name('store');

        // Pantau (List Peserta & Buku Kenangan)
        Route::get('/list', 'listPeserta')->name('list');
        Route::get('/yearbook', 'yearbook')->name('yearbook');

        // Cetak Dokumen (Sub-group)
        // URL: /graduation/print/... | Name: graduation.print.
        Route::prefix('print')->name('print.')->group(function () {
            Route::get('/biodata', 'printBiodata')->name('biodata');
            Route::get('/draft', 'printDraft')->name('draft');
            Route::get('/invitation', 'printInvitation')->name('invitation');
        });
    });

    // --- Buku Panduan ---
    Route::get('/manual-book', function () {
        return view('manual-book');
    })->name('manual.book');
});


// ==========================================
// 3. RUTE KHUSUS ADMIN (FULL ACCESS)
// ==========================================
// Middleware 'admin' harus sudah didaftarkan di kernel/bootstrap
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Manajemen Periode Wisuda (Resource Controller otomatis buat index, create, store, dll)
    Route::resource('periods', GraduationPeriodController::class);

    // Verifikasi Pendaftaran
    Route::controller(VerificationController::class)
        ->prefix('verification')
        ->name('verification.')
        ->group(function () {
            Route::get('/', 'index')->name('index'); 
            Route::patch('/update/{id}', 'updateStatus')->name('update'); 
            Route::delete('/delete/{id}', 'destroy')->name('destroy'); 
        });

    // Kelola Pengumuman
    Route::controller(AnnouncementController::class)
        ->prefix('announcements')
        ->name('announcements.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

    // Laporan & Cetak
    Route::controller(ReportController::class)
        ->prefix('reports')
        ->name('reports.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/print', 'print')->name('print');
        });
}); 

require __DIR__.'/auth.php';