@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Jadwal & Kuota Wisuda</h1>
        <a href="{{ route('admin.periods.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            + Tambah Periode
        </a>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-4">Nama Periode</th>
                    <th class="px-6 py-4">Tanggal Wisuda</th>
                    <th class="px-6 py-4 text-center">Kuota</th>
                    <th class="px-6 py-4 text-center">Pendaftar</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($periods as $period)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-medium text-slate-800">{{ $period->name }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ \Carbon\Carbon::parse($period->graduation_date)->translatedFormat('d F Y') }}</td>
                    <td class="px-6 py-4 text-center text-slate-600">
                        <span class="bg-slate-100 text-slate-700 px-2 py-1 rounded text-xs font-bold">
                            {{ $period->quota }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        {{-- Menghitung jumlah pendaftar di periode ini --}}
                        <span class="text-blue-600 font-bold">{{ $period->registrations->count() }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($period->status == 'open')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Dibuka</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">Ditutup</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('admin.periods.edit', $period->id) }}" class="text-yellow-600 hover:text-yellow-700 font-medium text-sm">Edit</a>
                        
                        <form action="{{ route('admin.periods.destroy', $period->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus periode ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                        Belum ada jadwal wisuda yang dibuat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection