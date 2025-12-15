@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('admin.periods.index') }}" class="text-slate-500 hover:text-slate-700 transition mb-2 inline-block">
            &larr; Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Periode Wisuda Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('admin.periods.store') }}" method="POST">
            @csrf

            {{-- Nama Periode --}}
            <div class="mb-4">
                <label class="block text-slate-700 font-medium mb-2">Nama Periode</label>
                <input type="text" name="name" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Periode IV - Desember 2025" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                {{-- Tanggal --}}
                <div>
                    <label class="block text-slate-700 font-medium mb-2">Tanggal Wisuda</label>
                    <input type="date" name="graduation_date" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                {{-- Kuota --}}
                <div>
                    <label class="block text-slate-700 font-medium mb-2">Kuota Peserta</label>
                    <input type="number" name="quota" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 500" required>
                </div>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block text-slate-700 font-medium mb-2">Status Pendaftaran</label>
                <select name="status" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="open">Dibuka (Open)</option>
                    <option value="closed">Ditutup (Closed)</option>
                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-6">
                <label class="block text-slate-700 font-medium mb-2">Keterangan Tambahan (Opsional)</label>
                <textarea name="description" rows="3" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium w-full md:w-auto">
                Simpan Periode
            </button>
        </form>
    </div>
</div>
@endsection