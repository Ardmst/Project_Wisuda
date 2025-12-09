@extends('layouts.app')

@section('header', 'Daftar Peserta Wisuda')

@section('content')
<div class="space-y-6">

    {{-- CARD FILTER --}}
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
        <form action="{{ route('graduation.list') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                
                {{-- Filter Prodi --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                    <select name="prodi" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Semua Prodi --</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi }}" {{ request('prodi') == $prodi ? 'selected' : '' }}>
                                {{ $prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Angkatan --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Angkatan</label>
                    <input type="number" name="angkatan" value="{{ request('angkatan') }}" placeholder="Tahun (cth: 2020)"
                           class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Cari Nama/NIM --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari Mahasiswa</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau NIM..."
                           class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Tombol Action --}}
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center justify-center flex-1">
                        <i class="fas fa-search mr-2"></i> Cari
                    </button>
                    <a href="{{ route('graduation.list') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition flex items-center justify-center">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- TABEL DATA --}}
    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-center w-10">No</th>
                        <th class="py-3 px-6">Nama Mahasiswa</th>
                        <th class="py-3 px-6">NIM</th>
                        <th class="py-3 px-6">Prodi</th>
                        <th class="py-3 px-6 text-center">Angkatan</th>
                        <th class="py-3 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participants as $index => $data)
                        <tr class="bg-white border-b hover:bg-blue-50 transition">
                            <td class="py-4 px-6 text-center">{{ $participants->firstItem() + $index }}</td>
                            <td class="py-4 px-6 font-medium text-gray-900">
                                {{ $data->user->name }}
                                @if(Auth::id() == $data->user_id)
                                    <span class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">Anda</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">{{ $data->user->nim }}</td>
                            <td class="py-4 px-6">{{ $data->user->major }}</td>
                            <td class="py-4 px-6 text-center">{{ $data->user->cohort ?? '-' }}</td>
                            <td class="py-4 px-6 text-center">
                                @if($data->status == 'verified')
                                    <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full border border-green-200">
                                        <i class="fas fa-check mr-1"></i> Terverifikasi
                                    </span>
                                @elseif($data->status == 'rejected')
                                    <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full border border-red-200">
                                        <i class="fas fa-times mr-1"></i> Ditolak
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full border border-yellow-200">
                                        <i class="fas fa-clock mr-1"></i> Menunggu
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400">
                                <i class="fas fa-folder-open text-4xl mb-3 block"></i>
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div class="p-4 border-t bg-gray-50">
            {{ $participants->withQueryString()->links() }}
        </div>
    </div>

</div>
@endsection