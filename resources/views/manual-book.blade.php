@extends('layouts.app')

@section('content')
    {{-- Breadcrumb & Judul Halaman --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-2xl font-semibold text-gray-700">Manual Book</h3>
        </div>
    </div>

    {{-- Kartu Konten Utama --}}
    <div class="bg-white rounded-lg shadow-md p-6 lg:p-8">
        {{-- Bagian Keterangan --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
            <h4 class="font-bold text-blue-800">KETERANGAN</h4>
        </div>

        {{-- Sub-judul Mahasiswa --}}
        <div class="mb-6">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-100 p-2 rounded-md">
                    <i class="fas fa-user-graduate text-blue-600"></i>
                </div>
                <h5 class="text-lg font-semibold text-gray-700">Mahasiswa Lulus</h5>
            </div>
        </div>

        {{-- Daftar Manual Book --}}
        <div class="space-y-3">
            @php
                // Array ini menyimpan data untuk setiap manual book
                $manuals = [
                    [
                        'title' => 'Draft Ijazah',
                        'link' => 'https://cdnb.uns.ac.id/wisuda/manualbook/NA%3DWisuda%20UNS%20-%20draft%20ijazah%20mhs.pdf'
                    ],
                    [
                        'title' => 'Galeri Foto',
                        'link' => 'https://cdnb.uns.ac.id/wisuda/manualbook/MTY%3DWisuda%20UNS%20-%20Galeri%20Foto%20%28Mahasiswa%29.pdf'
                    ],
                    [
                        'title' => 'Penerbitan Ijazah (Mahasiswa)',
                        'link' => 'https://cdnb.uns.ac.id/wisuda/manualbook/MTY%3DWisuda%20UNS%20-%20Penerbitan%20Ijazah%20%28Mahasiswa%29.pdf'
                    ]
                ];
            @endphp

            {{-- Looping untuk menampilkan setiap item manual --}}
            @foreach ($manuals as $index => $manual)
            <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 transition">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-500 font-medium w-5 text-center">{{ $index + 1 }}</span>
                    <span class="text-gray-800 font-medium">{{ $manual['title'] }}</span>
                </div>
                <a href="{{ $manual['link'] }}" target="_blank" class="px-4 py-2 bg-teal-400 text-white text-sm font-semibold rounded-md hover:bg-teal-500 transition-colors">
                    Manual Book
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
