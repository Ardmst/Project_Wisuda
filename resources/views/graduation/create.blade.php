@extends('layouts.app')

{{-- Set judul header --}}
@section('header', 'Form Pendaftaran Wisuda')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 md:p-8">
    
    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Formulir Pendaftaran Wisuda</h3>
    <p class="text-gray-600 mb-6">Pastikan semua data diisi dengan benar. Data yang sudah dikirim tidak dapat diubah.</p>

    <!-- Form Pendaftaran -->
    <form action="{{ route('graduation.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Data Diri (Read-only) -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                <input type="text" id="name" value="{{ Auth::user()->name }}" 
                       class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-400 focus:border-gray-400 sm:text-sm" readonly>
            </div>
            <div>
                <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                <input type="text" id="nim" value="{{ Auth::user()->nim }}" 
                       class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-400 focus:border-gray-400 sm:text-sm" readonly>
            </div>
            <div>
                <label for="faculty" class="block text-sm font-medium text-gray-700">Fakultas</label>
                <input type="text" id="faculty" value="{{ Auth::user()->faculty }}" 
                       class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-400 focus:border-gray-400 sm:text-sm" readonly>
            </div>
            <div>
                <label for="major" class="block text-sm font-medium text-gray-700">Program Studi</label>
                <input type="text" id="major" value="{{ Auth::user()->major }}" 
                       class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-400 focus:border-gray-400 sm:text-sm" readonly>
            </div>

            <!-- Garis Pemisah -->
            <div class="md:col-span-2 my-2">
                <hr>
            </div>

            <!-- Input Nama Orang Tua / Wali -->
            <div class="md:col-span-2">
                <label for="parent_name" class="block text-sm font-medium text-gray-700">Nama Orang Tua / Wali (Sesuai Undangan)</label>
                <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name') }}"
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('parent_name') border-red-500 @enderror" 
                       placeholder="Contoh: Bpk. John Doe & Ibu Jane Doe" required>
                
                @error('parent_name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Ukuran Toga -->
            <div>
                <label for="toga_size" class="block text-sm font-medium text-gray-700">Ukuran Toga</label>
                <select name="toga_size" id="toga_size" 
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('toga_size') border-red-500 @enderror" required>
                    <option value="" disabled {{ old('toga_size') ? '' : 'selected' }}>Pilih Ukuran</option>
                    <option value="S" {{ old('toga_size') == 'S' ? 'selected' : '' }}>S (Small)</option>
                    <option value="M" {{ old('toga_size') == 'M' ? 'selected' : '' }}>M (Medium)</option>
                    <option value="L" {{ old('toga_size') == 'L' ? 'selected' : '' }}>L (Large)</option>
                    <option value="XL" {{ old('toga_size') == 'XL' ? 'selected' : '' }}>XL (Extra Large)</option>
                    <option value="XXL" {{ old('toga_size') == 'XXL' ? 'selected' : '' }}>XXL (Double Extra Large)</option>
                </select>

                @error('toga_size')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <!-- Spacer, bisa diisi input lain nanti -->
            </div>

            <!-- Input IPK -->
            <div>
                <label for="ipk" class="block text-sm font-medium text-gray-700">IPK (Indeks Prestasi Kumulatif)</label>
                <input type="number" step="0.01" min="0" max="4" name="ipk" id="ipk" value="{{ old('ipk') }}"
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ipk') border-red-500 @enderror" 
                       placeholder="Contoh: 3.85" required>
                
                @error('ipk')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input IPS -->
            <div>
                <label for="ips" class="block text-sm font-medium text-gray-700">IPS (Indeks Prestasi Semester Terakhir)</label>
                <input type="number" step="0.01" min="0" max="4" name="ips" id="ips" value="{{ old('ips') }}"
                       class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('ips') border-red-500 @enderror" 
                       placeholder="Contoh: 3.90" required>
                
                @error('ips')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end">
            <button type="submit" 
                    class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                Kirim Pendaftaran
            </button>
        </div>
    </form>
</div>
@endsection

