@extends('layouts.app')

@section('header', 'Buku Kenangan Wisudawan')

@section('content')
<div class="space-y-8">

    {{-- Header Banner --}}
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-xl p-8 text-center text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-serif font-bold tracking-widest text-yellow-500 mb-2">ALUMNI CLASS OF {{ date('Y') }}</h2>
            <p class="text-slate-300">"Setiap akhir adalah awal yang baru. Teruslah melangkah dan berkarya."</p>
        </div>
        {{-- Hiasan Background --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    </div>

    {{-- Grid Album --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($graduates as $grad)
        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 group">
            
            {{-- Bagian Foto (Dummy Placeholder) --}}
            <div class="h-48 bg-gray-200 relative overflow-hidden">
                {{-- Kita pakai UI Avatars karena belum ada fitur upload foto --}}
                <img src="https://ui-avatars.com/api/?name={{ urlencode($grad->user->name) }}&background=random&size=512" 
                     alt="{{ $grad->user->name }}" 
                     class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                
                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent p-4">
                    <span class="text-yellow-400 font-bold text-xs tracking-wider uppercase border border-yellow-400 px-2 py-1 rounded">
                        {{ $grad->user->major }}
                    </span>
                </div>
            </div>

            {{-- Bagian Info --}}
            <div class="p-6 text-center">
                <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-blue-600 transition">{{ $grad->user->name }}</h3>
                <p class="text-sm text-gray-500 mb-4">{{ $grad->user->nim }}</p>
                
                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                    <p class="text-xs text-gray-400 uppercase font-bold mb-1">Judul Skripsi</p>
                    <p class="text-xs text-gray-700 italic line-clamp-3">"{{ $grad->thesis_title }}"</p>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $graduates->links() }}
    </div>

</div>
@endsection