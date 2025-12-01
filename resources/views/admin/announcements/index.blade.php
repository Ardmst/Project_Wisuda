@extends('layouts.app')

{{-- Judul Header --}}
@section('header', 'Kelola Pengumuman')

@section('content')
    {{-- Wrapper Utama (Menggunakan style yang sama dengan halaman Verifikasi agar layout tidak rusak) --}}
    <div class="bg-white rounded-lg shadow-lg p-6 md:p-8">
        
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-bullhorn mr-3 text-blue-600"></i> Kelola Pengumuman
        </h3>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded relative bg-green-100 border border-green-400 text-green-700">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- KOLOM KIRI: FORM INPUT --}}
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <h4 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Buat Pengumuman Baru</h4>
                
                <form action="{{ route('admin.announcements.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                        <input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required placeholder="Contoh: Info Gladi Bersih">
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Isi Pengumuman</label>
                        <textarea name="content" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required placeholder="Tulis detailnya di sini..."></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        <i class="fas fa-paper-plane mr-2"></i> Terbitkan
                    </button>
                </form>
            </div>

            {{-- KOLOM KANAN: TABEL RIWAYAT --}}
            <div>
                <h4 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">Riwayat Pengumuman</h4>
                
                @if($announcements->isEmpty())
                    <p class="text-gray-500 italic">Belum ada pengumuman.</p>
                @else
                    <div class="space-y-4">
                        @foreach($announcements as $info)
                            <div class="bg-white border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h5 class="font-bold text-gray-800">{{ $info->title }}</h5>
                                        <p class="text-xs text-gray-500 mb-2">{{ $info->created_at->format('d M Y, H:i') }} WIB</p>
                                    </div>
                                    
                                    <form action="{{ route('admin.announcements.destroy', $info->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">{{ $info->content }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection