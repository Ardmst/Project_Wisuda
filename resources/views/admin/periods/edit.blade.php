@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('admin.periods.index') }}" class="text-slate-500 hover:text-slate-700 transition mb-2 inline-block">
            &larr; Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Edit Periode Wisuda</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('admin.periods.update', $period->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Wajib ada untuk update data --}}

            {{-- Nama Periode --}}
            <div class="mb-4">
                <label class="block text-slate-700 font-medium mb-2">Nama Periode</label>
                <input type="text" name="name" value="{{ old('name', $period->name) }}" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                {{-- Tanggal --}}
                <div>
                    <label class="block text-slate-700 font-medium mb-2">Tanggal Wisuda</label>
                    <input type="date" name="graduation_date" value="{{ old('graduation_date', $period->graduation_date) }}" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                {{-- Kuota --}}
                <div>
                    <label class="block text-slate-700 font-medium mb-2">Kuota Peserta</label>
                    <input type="number" name="quota" value="{{ old('quota', $period->quota) }}" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block text-slate-700 font-medium mb-2">Status Pendaftaran</label>
                <select name="status" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="open" {{ $period->status == 'open' ? 'selected' : '' }}>Dibuka (Open)</option>
                    <option value="closed" {{ $period->status == 'closed' ? 'selected' : '' }}>Ditutup (Closed)</option>
                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-6">
                <label class="block text-slate-700 font-medium mb-2">Keterangan Tambahan (Opsional)</label>
                <textarea name="description" rows="3" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description', $period->description) }}</textarea>
            </div>

            <div class="flex space-x-3">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                    Update Perubahan
                </button>
                <a href="{{ route('admin.periods.index') }}" class="bg-slate-100 text-slate-700 px-6 py-2 rounded-lg hover:bg-slate-200 transition font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection