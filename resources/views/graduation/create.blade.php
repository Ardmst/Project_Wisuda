@extends('layouts.app')

@section('header', 'Pendaftaran Wisuda')

@section('content')
<div class="max-w-4xl mx-auto">
    
    {{-- LOGIKA: JIKA SUDAH DAFTAR, TAMPILKAN STATUS --}}
    @if($registration)
        <div class="bg-white rounded-xl shadow-lg p-8 text-center border-t-4 {{ $registration->status == 'verified' ? 'border-green-500' : ($registration->status == 'rejected' ? 'border-red-500' : 'border-yellow-500') }}">
            
            <div class="mb-4">
                @if($registration->status == 'pending')
                    <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-3xl text-yellow-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Pendaftaran Sedang Diverifikasi</h2>
                    <p class="text-slate-600 mt-2">Data Anda sudah masuk ke sistem. Mohon tunggu admin melakukan verifikasi berkas.</p>
                
                @elseif($registration->status == 'verified')
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-3xl text-green-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Selamat! Anda Terdaftar</h2>
                    <p class="text-slate-600 mt-2">Anda resmi menjadi calon wisudawan {{ $registration->period->name }}.</p>
                    <div class="mt-6">
                         <a href="{{ route('graduation.print.biodata') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Cetak Biodata</a>
                    </div>

                @else
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-times-circle text-3xl text-red-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Pendaftaran Ditolak</h2>
                    <p class="text-slate-600 mt-2">Mohon hubungi bagian akademik untuk informasi lebih lanjut.</p>
                @endif
            </div>

            <div class="bg-slate-50 p-4 rounded-lg text-left mt-6 max-w-lg mx-auto">
                <p class="text-sm text-slate-500">Judul Skripsi:</p>
                <p class="font-medium text-slate-800 mb-2">{{ $registration->thesis_title }}</p>
                <p class="text-sm text-slate-500">Tanggal Daftar:</p>
                <p class="font-medium text-slate-800">{{ $registration->created_at->format('d F Y H:i') }} WIB</p>
            </div>
        </div>

    {{-- LOGIKA: JIKA BELUM DAFTAR, TAMPILKAN FORM --}}
    @else
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-blue-600 p-6 text-white">
                <h2 class="text-xl font-bold">Formulir Pendaftaran Wisuda</h2>
                <p class="text-blue-100 text-sm mt-1">Isi data dengan teliti. Data akan dicetak di ijazah.</p>
            </div>
            
            <form action="{{ route('graduation.store') }}" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="graduation_period_id" value="{{ $period->id }}">

                {{-- Alert Info Periode --}}
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                Anda mendaftar untuk: <span class="font-bold">{{ $period->name }}</span><br>
                                Tanggal Pelaksanaan: {{ \Carbon\Carbon::parse($period->graduation_date)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap (Sesuai Ijazah)</label>
                        <input type="text" value="{{ Auth::user()->name }}" class="w-full bg-slate-100 border-slate-300 rounded-lg text-slate-500" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">NIM</label>
                        <input type="text" value="{{ Auth::user()->nim }}" class="w-full bg-slate-100 border-slate-300 rounded-lg text-slate-500" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Program Studi</label>
                        <input type="text" value="{{ Auth::user()->major }}" class="w-full bg-slate-100 border-slate-300 rounded-lg text-slate-500" disabled>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Orang Tua (Untuk Undangan)</label>
                        <input type="text" name="parent_name" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required placeholder="Contoh: Bpk. Suparman">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Judul Skripsi / Tugas Akhir</label>
                    <textarea name="thesis_title" rows="2" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required placeholder="Judul lengkap sesuai revisi terakhir..."></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">IPK Terakhir</label>
                        <input type="number" step="0.01" name="ipk" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required placeholder="3.xx">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nilai Skripsi (Angka)</label>
                        <input type="number" step="0.01" name="ips" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required placeholder="4.00">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Ukuran Toga</label>
                        <select name="toga_size" class="w-full border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="S">S</option>
                            <option value="M" selected>M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end border-t pt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 font-medium shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-0.5">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection