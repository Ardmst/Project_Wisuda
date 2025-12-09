@extends('layouts.app')

@section('header', 'Buku Panduan & Manual Book')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    
    <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Dokumen Panduan</h3>
            <p class="text-sm text-gray-500">Unduh panduan penggunaan sistem untuk setiap fitur.</p>
        </div>
        <i class="fas fa-book-reader text-4xl text-blue-100"></i>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white border-b border-gray-200 text-xs uppercase text-gray-500 font-semibold">
                    <th class="px-6 py-4 w-16 text-center">No</th>
                    <th class="px-6 py-4">Keterangan Dokumen</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                
                {{-- ITEM 1: DRAFT IJAZAH --}}
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-4 text-center font-bold text-gray-400">1</td>
                    <td class="px-6 py-4 font-medium text-gray-700">
                        Panduan Draft Ijazah
                        <span class="block text-xs text-gray-400 font-normal mt-1">Cara cek dan validasi draft ijazah sebelum cetak.</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-bold">Mahasiswa Lulus</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ asset('manuals/panduan_draft_ijazah.pdf') }}" target="_blank" ...>
   <i class="fas fa-file-pdf mr-2"></i> Download PDF
</a>
                    </td>
                </tr>

                {{-- ITEM 2: GALERI FOTO --}}
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-4 text-center font-bold text-gray-400">2</td>
                    <td class="px-6 py-4 font-medium text-gray-700">
                        Panduan Galeri Foto
                        <span class="block text-xs text-gray-400 font-normal mt-1">Akses dokumentasi dan buku kenangan wisuda.</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-bold">Umum</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ asset('manuals/panduan_galeri_foto.pdf') }}" target="_blank" ...>
   <i class="fas fa-file-pdf mr-2"></i> Download PDF
</a>
                    </td>
                </tr>

                {{-- ITEM 3: PENERBITAN IJAZAH --}}
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-6 py-4 text-center font-bold text-gray-400">3</td>
                    <td class="px-6 py-4 font-medium text-gray-700">
                        Alur Penerbitan Ijazah (Mahasiswa)
                        <span class="block text-xs text-gray-400 font-normal mt-1">Prosedur pengambilan ijazah asli dan legalisir.</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-bold">Administrasi</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ asset('manuals/alur_penerbitan_ijazah.pdf') }}" target="_blank" ...>
   <i class="fas fa-file-pdf mr-2"></i> Download PDF
</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
@endsection