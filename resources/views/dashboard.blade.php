@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')

    {{-- LOGIKA PHP DI VIEW --}}
    @php
        $announcements = \App\Models\Announcement::latest()->take(3)->get();
        
        // Ambil data pendaftaran user ini
        $registration = \App\Models\GraduationRegistration::where('user_id', Auth::id())->first();
        $isRegistered = $registration ? true : false;
        $status = $registration ? $registration->status : null;
    @endphp

    {{-- 1. SECTION NOTIFIKASI --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 border-l-4 border-green-500 text-green-700 shadow-sm flex items-center">
            <i class="fas fa-check-circle text-xl mr-3"></i>
            <div>
                <span class="font-bold">Sukses!</span> {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- 2. STATUS PENDAFTARAN (BANNER) --}}
    @if($isRegistered)
        <div class="mb-8 p-6 rounded-xl shadow-sm border 
            {{ $status == 'verified' ? 'bg-green-50 border-green-200' : ($status == 'rejected' ? 'bg-red-50 border-red-200' : 'bg-yellow-50 border-yellow-200') }}">
            
            <h4 class="text-lg font-bold flex items-center {{ $status == 'verified' ? 'text-green-800' : ($status == 'rejected' ? 'text-red-800' : 'text-yellow-800') }}">
                @if($status == 'verified')
                    <i class="fas fa-check-circle mr-2"></i> Pendaftaran Diterima
                @elseif($status == 'rejected')
                    <i class="fas fa-times-circle mr-2"></i> Pendaftaran Ditolak
                @else
                    <i class="fas fa-clock mr-2"></i> Menunggu Verifikasi
                @endif
            </h4>
            
            <p class="mt-1 text-sm {{ $status == 'verified' ? 'text-green-700' : ($status == 'rejected' ? 'text-red-700' : 'text-yellow-700') }}">
                @if($status == 'verified')
                    Selamat! Berkas Anda telah diverifikasi. Silakan cetak dokumen wisuda di bawah ini.
                @elseif($status == 'rejected')
                    Maaf, berkas Anda ditolak. Silakan hubungi admin prodi untuk informasi lebih lanjut.
                @else
                    Data Anda sedang diverifikasi oleh admin. Mohon cek secara berkala.
                @endif
            </p>
        </div>
    @endif

    {{-- 3. GRID LAYOUT UTAMA --}}
    <div class="flex flex-col lg:flex-row gap-8">
        
        {{-- KOLOM KIRI (MENU UTAMA) --}}
        <div class="flex-1 space-y-8">
            
            <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-1 text-gray-500 text-sm">Selamat datang di Sistem Informasi Wisuda.</p>
                </div>
                <div class="hidden md:block bg-blue-50 p-3 rounded-full">
                    <i class="fas fa-user-graduate text-3xl text-blue-500"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-alt text-xl"></i>
                    </div>
                    <h5 class="font-bold text-gray-700">Jadwal</h5>
                    <p class="text-xs text-gray-500 mt-1">Cek agenda wisuda</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-12 h-12 mx-auto bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-info-circle text-xl"></i>
                    </div>
                    <h5 class="font-bold text-gray-700">Layanan</h5>
                    <p class="text-xs text-gray-500 mt-1">Bantuan & Info</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center hover:shadow-md transition">
                    <div class="w-12 h-12 mx-auto bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-award text-xl"></i>
                    </div>
                    <h5 class="font-bold text-gray-700">Sertifikat</h5>
                    <p class="text-xs text-gray-500 mt-1">Digital Certificate</p>
                </div>
            </div>

            {{-- SECTION DOKUMEN (HANYA JIKA SUDAH DAFTAR) --}}
            @if($isRegistered)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h4 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">
                        <i class="fas fa-print mr-2 text-gray-500"></i> Dokumen Anda
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('graduation.print.biodata') }}" target="_blank" 
                           class="flex items-center p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition group">
                            <div class="p-3 bg-green-500 text-white rounded-lg mr-4 shadow-sm group-hover:scale-110 transition">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-green-800 text-sm">Cetak Biodata</h5>
                                <p class="text-xs text-green-600">Bukti Pendaftaran</p>
                            </div>
                        </a>

                        <a href="{{ route('graduation.print.draft') }}" target="_blank" 
                           class="flex items-center p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition group">
                            <div class="p-3 bg-blue-500 text-white rounded-lg mr-4 shadow-sm group-hover:scale-110 transition">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-blue-800 text-sm">Draft Ijazah</h5>
                                <p class="text-xs text-blue-600">Preview Dokumen</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

        </div>

        {{-- KOLOM KANAN (PENGUMUMAN STICKY) --}}
        <div class="w-full lg:w-1/3">
            <div class="bg-white rounded-xl shadow-lg border border-blue-100 overflow-hidden sticky top-24">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-5 py-4 flex justify-between items-center">
                    <h3 class="font-bold text-white text-base flex items-center">
                        <i class="fas fa-bullhorn mr-2"></i> Papan Pengumuman
                    </h3>
                </div>
                
                <div class="p-5 bg-gray-50 space-y-4 max-h-[500px] overflow-y-auto">
                    @if($announcements->isEmpty())
                        <div class="text-center py-8 text-gray-400">
                            <p class="text-sm italic">Belum ada pengumuman.</p>
                        </div>
                    @else
                        @foreach($announcements as $info)
                            <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-blue-500 hover:shadow-md transition group">
                                <div class="mb-2">
                                    <h4 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-blue-600 transition">
                                        {{ $info->title }}
                                    </h4>
                                </div>
                                <p class="text-gray-600 text-xs mb-3 line-clamp-3 leading-relaxed">
                                    {{ $info->content }}
                                </p>
                                <div class="flex justify-end">
                                    <span class="text-[10px] font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded-full border border-gray-200">
                                        {{ $info->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection