@extends('layouts.app')

@section('header', 'Laporan & Filter Data')

@section('content')
<div class="space-y-6">

    {{-- 1. SUMMARY CARDS (STATISTIK) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 print:hidden">
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Mahasiswa</p>
                <h4 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalSiswa }}</h4>
            </div>
            <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                <i class="fas fa-users text-2xl"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Sudah Lulus</p>
                <h4 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalLulus }}</h4>
            </div>
            <div class="p-3 bg-green-50 rounded-full text-green-600">
                <i class="fas fa-graduation-cap text-2xl"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-500 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Masih Aktif</p>
                <h4 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalAktif }}</h4>
            </div>
            <div class="p-3 bg-yellow-50 rounded-full text-yellow-600">
                <i class="fas fa-user-clock text-2xl"></i>
            </div>
        </div>
    </div>

    {{-- 2. CARD FILTER & CETAK (LAYOUT RAPI) --}}
    <div class="bg-white rounded-lg shadow-sm p-6 print:hidden">
        
        {{-- Flex Container: Kiri (Form) dan Kanan (Cetak) --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-4">
            
            {{-- BAGIAN KIRI: FORM FILTER --}}
            <form action="{{ route('admin.reports.index') }}" method="GET" class="w-full md:w-auto flex flex-col md:flex-row gap-4 items-end">
                
                {{-- Dropdown --}}
                <div class="w-full md:w-72">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Filter Program Studi</label>
                    <select name="prodi" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                        <option value="">-- Semua Prodi --</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>
                                {{ $prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol Action --}}
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition">
                        <i class="fas fa-filter mr-1"></i> Terapkan
                    </button>
                    
                    <a href="{{ route('admin.reports.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition">
                        Reset
                    </a>
                </div>
            </form>

            {{-- BAGIAN KANAN: TOMBOL CETAK (Membuka Tab Baru) --}}
            <a href="{{ route('admin.reports.print', ['prodi' => request('prodi')]) }}" 
               target="_blank" 
               class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-sm transition flex items-center">
                <i class="fas fa-print mr-2"></i> Cetak Laporan
            </a>

        </div>
    </div>

    {{-- 3. TABEL DATA --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Pratinjau Data</h3>
        </div>
        
        @if($students->isEmpty())
            <div class="p-10 text-center text-gray-500 italic">
                <i class="fas fa-search text-4xl mb-3 text-gray-300"></i>
                <p>Data tidak ditemukan untuk filter ini.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="py-4 px-6 border-b">No</th>
                            <th class="py-4 px-6 border-b">Nama</th>
                            <th class="py-4 px-6 border-b">NIM</th>
                            <th class="py-4 px-6 border-b">Prodi</th>
                            <th class="py-4 px-6 border-b">Angkatan</th>
                            <th class="py-4 px-6 border-b text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $mhs)
                        <tr class="bg-white border-b hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium text-gray-900">
                                {{ $students->firstItem() + $index }}
                            </td>
                            <td class="py-4 px-6 font-medium text-gray-900">{{ $mhs->name }}</td>
                            <td class="py-4 px-6">{{ $mhs->nim ?? '-' }}</td>
                            <td class="py-4 px-6">{{ $mhs->major }}</td>
                            <td class="py-4 px-6">{{ $mhs->cohort }}</td>
                            <td class="py-4 px-6 text-center">
                                @if($mhs->status == 'lulus')
                                    <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">Lulus</span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">Aktif</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t bg-gray-50">
                {{ $students->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection