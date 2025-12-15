@extends('layouts.app')

{{-- Set judul header sesuai layout kustom --}}
@section('header', 'Dashboard Admin')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6 md:p-8">
        
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Selamat Datang, Admin!</h3>

        {{-- Tampilkan notifikasi sukses/error jika ada --}}
        @if (session('success'))
            <div class="mb-4 px-4 py-3 rounded relative bg-green-100 border border-green-400 text-green-700" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
         @if (session('error'))
            <div class="mb-4 px-4 py-3 rounded relative bg-red-100 border border-red-400 text-red-700" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow" role="alert">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-bold text-lg">Verifikasi Pending</p>
                        <h3 class="text-3xl font-bold text-slate-800">{{ $pendingCount }}</h3>
                        <p class="text-sm text-yellow-600">Mahasiswa menunggu verifikasi</p>
                    </div>
                    <i class="fa-solid fa-clock text-2xl opacity-50"></i>
                </div>
                <a href="{{ route('admin.verification.index') }}" class="text-sm font-semibold text-yellow-800 hover:underline mt-4 inline-block">
                    Lihat Detail &rarr;
                </a>
            </div>

            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow" role="alert">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-bold text-lg">Kelola Pengumuman</p>
                        <p class="text-sm mt-1">Update informasi terbaru di dashboard mahasiswa.</p>
                    </div>
                    <i class="fa-solid fa-bullhorn text-2xl opacity-50"></i>
                </div>
                 {{-- ROUTE SUDAH DISAMBUNGKAN --}}
                <a href="{{ route('admin.announcements.index') }}" class="text-sm font-semibold text-blue-800 hover:underline mt-4 inline-block">
                    Kelola Sekarang &rarr;
                </a>
            </div>

            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow" role="alert">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-bold text-lg">Laporan & Filter</p>
                        <p class="text-sm mt-1">Cetak data wisudawan dan filter berdasarkan prodi.</p>
                    </div>
                    <i class="fa-solid fa-file-pdf text-2xl opacity-50"></i>
                </div>
                 {{-- ROUTE SUDAH DISAMBUNGKAN --}}
                <a href="{{ route('admin.reports.index') }}" class="text-sm font-semibold text-green-800 hover:underline mt-4 inline-block">
                    Buka Laporan &rarr;
                </a>
            </div>

        </div>

    </div>
@endsection