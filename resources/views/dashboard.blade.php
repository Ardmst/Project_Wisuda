@extends('layouts.app')

{{-- Set judul header --}}
@section('header', 'Dashboard')

@section('content')

    @php
        $announcements = \App\Models\Announcement::latest()->take(3)->get();
    @endphp

    @if (session('success'))
        <div class="mb-6 rounded-lg bg-green-100 p-4 text-sm text-green-700" role="alert">
            <span class="font-medium">Sukses!</span> {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 rounded-lg bg-red-100 p-4 text-sm text-red-700" role="alert">
            <span class="font-medium">Error!</span> {{ session('error') }}
        </div>
    @endif
    @if (session('info'))
        <div class="mb-6 rounded-lg bg-blue-100 p-4 text-sm text-blue-700" role="alert">
            <span class="font-medium">Info:</span> {{ session('info') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row gap-6 mb-8">
        
        <div class="flex-1">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-3xl font-medium text-gray-700">Selamat Datang di Sistem Wisuda</h3>
                    <p class="mt-1 text-sm text-gray-500">Akses menu cepat di bawah ini untuk mengelola data wisuda Anda.</p>
                </div>
                <img src="{{ asset('images/graduatehat.webp') }}" alt="Topi Wisuda" class="w-20 h-20 object-contain hidden md:block">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-blue-100 p-4 rounded-full">
                        <i class="fa-solid fa-calendar-check fa-2x text-blue-500"></i>
                    </div>
                    <h4 class="mt-4 text-lg font-semibold text-gray-700">Manajemen Jadwal</h4>
                    <p class="mt-2 text-sm text-gray-500">Atur dan lihat jadwal penting terkait prosesi wisuda Anda.</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-purple-100 p-4 rounded-full">
                        <i class="fa-solid fa-graduation-cap fa-2x text-purple-500"></i>
                    </div>
                    <h4 class="mt-4 text-lg font-semibold text-gray-700">Pelayanan Wisuda</h4>
                    <p class="mt-2 text-sm text-gray-500">Akses semua layanan administrasi untuk kelancaran wisuda.</p>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center hover:shadow-xl transition-shadow duration-300">
                    <div class="bg-orange-100 p-4 rounded-full">
                        <i class="fa-solid fa-file-invoice fa-2x text-orange-500"></i>
                    </div>
                    <h4 class="mt-4 text-lg font-semibold text-gray-700">Cetak Ijazah & Sertifikat</h4>
                    <p class="mt-2 text-sm text-gray-500">Unduh dokumen kelulusan resmi Anda setelah proses selesai.</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-blue-100">
                <div class="bg-blue-600 px-4 py-3 border-b border-blue-700 flex justify-between items-center">
                    <h3 class="font-bold text-white text-lg"><i class="fa-solid fa-bullhorn mr-2"></i> Pengumuman</h3>
                </div>
                
                <div class="p-4 bg-blue-50 h-full min-h-[200px]">
                    @if($announcements->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            <i class="fa-regular fa-bell-slash text-2xl mb-2 block"></i>
                            <p class="text-sm">Belum ada pengumuman terbaru.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($announcements as $info)
                                <div class="bg-white p-3 rounded shadow-sm border-l-4 border-blue-500">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-bold text-gray-800 text-sm leading-tight">{{ $info->title }}</h4>
                                    </div>
                                    <p class="text-gray-600 text-xs mb-2">{{ \Illuminate\Support\Str::limit($info->content, 100) }}</p>
                                    <div class="text-right">
                                        <span class="text-[10px] text-gray-400 bg-gray-100 px-2 py-1 rounded-full">
                                            {{ $info->created_at->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
    
    <div class="flex justify-center items-center mt-12 pb-8">
        <div class="text-center">
            <img src="{{ asset('images/uns.webp') }}" alt="Logo UNS" class="h-20 mx-auto opacity-80 hover:opacity-100 transition-opacity">
            <p class="mt-3 text-base font-semibold text-gray-500">Universitas Sebelas Maret</p>
        </div>
    </div>

@endsection 