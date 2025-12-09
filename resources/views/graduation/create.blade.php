@extends('layouts.app')

{{-- Set judul header --}}
@section('header', 'Form Pendaftaran Wisuda')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 md:p-8">
    
    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Formulir Pendaftaran Wisuda</h3>
    <p class="text-gray-600 mb-6">Pastikan semua data diisi dengan benar. Data yang sudah dikirim tidak dapat diubah.</p>

    <form action="{{ route('graduation.store') }}" method="POST">
        @csrf
        
        {{-- SECTION 1: DATA DIRI MAHASISWA (READONLY) --}}
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
            <h4 class="text-sm font-bold text-gray-500 uppercase mb-4 border-b pb-2">Data Mahasiswa</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                    <input type="text" value="{{ Auth::user()->name }}" 
                           class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md text-gray-600 cursor-not-allowed" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" value="{{ Auth::user()->nim ?? '-' }}" 
                           class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md text-gray-600 cursor-not-allowed" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fakultas</label>
                    <input type="text" value="{{ Auth::user()->faculty ?? '-' }}" 
                           class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md text-gray-600 cursor-not-allowed" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <input type="text" value="{{ Auth::user()->major ?? '-' }}" 
                           class="mt-1 block w-full px-3 py-2 bg-gray-200 border border-gray-300 rounded-md text-gray-600 cursor-not-allowed" readonly>
                </div>
            </div>
        </div>

        {{-- SECTION 2: FORMULIR ISIAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- 1. Nama Orang Tua --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua / Wali (Untuk Undangan)</label>
                <input type="text" name="parent_name" value="{{ old('parent_name') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('parent_name') border-red-500 @enderror" 
                       placeholder="Contoh: Bpk. John Doe & Ibu Jane Doe" required>
                @error('parent_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 2. Ukuran Toga --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran Toga</label>
                <select name="toga_size" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('toga_size') border-red-500 @enderror" required>
                    <option value="" disabled selected>Pilih Ukuran</option>
                    <option value="S" {{ old('toga_size') == 'S' ? 'selected' : '' }}>S</option>
                    <option value="M" {{ old('toga_size') == 'M' ? 'selected' : '' }}>M</option>
                    <option value="L" {{ old('toga_size') == 'L' ? 'selected' : '' }}>L</option>
                    <option value="XL" {{ old('toga_size') == 'XL' ? 'selected' : '' }}>XL</option>
                    <option value="XXL" {{ old('toga_size') == 'XXL' ? 'selected' : '' }}>XXL</option>
                </select>
                @error('toga_size')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Spacer Kosong (Biar rapi) --}}
            <div class="hidden md:block"></div>

            {{-- 3. IPK --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">IPK (Indeks Prestasi Kumulatif)</label>
                <input type="number" step="0.01" name="ipk" value="{{ old('ipk') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('ipk') border-red-500 @enderror" 
                       placeholder="Contoh: 3.85" required>
                @error('ipk')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 4. IPS --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">IPS (Semester Terakhir)</label>
                <input type="number" step="0.01" name="ips" value="{{ old('ips') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('ips') border-red-500 @enderror" 
                       placeholder="Contoh: 3.90" required>
                @error('ips')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- 5. Judul Skripsi (Full Width) --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Skripsi / Tugas Akhir</label>
                <textarea name="thesis_title" rows="3" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 @error('thesis_title') border-red-500 @enderror" 
                          placeholder="Tuliskan judul lengkap sesuai pengesahan..." required>{{ old('thesis_title') }}</textarea>
                @error('thesis_title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Tombol Submit --}}
        <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition transform hover:scale-105 flex items-center">
                <i class="fas fa-paper-plane mr-2"></i> Kirim Pendaftaran
            </button>
        </div>
    </form>
</div>
@endsection