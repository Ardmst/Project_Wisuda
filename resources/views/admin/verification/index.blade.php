@extends('layouts.app')

{{-- Set judul header sesuai layout kustom --}}
@section('header', 'Verifikasi Pendaftaran Wisuda')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6 md:p-8">
        
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Daftar Pendaftaran Menunggu Verifikasi</h3>

        {{-- Tampilkan notifikasi sukses/error --}}
        @if (session('success'))
            <div class="mb-4 px-4 py-3 rounded relative bg-green-100 border border-green-400 text-green-700" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 px-4 py-3 rounded relative bg-red-100 border border-red-400 text-red-700" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Cek jika tidak ada pendaftaran --}}
        @if ($registrations->isEmpty())
            <p class="text-gray-600">Tidak ada pendaftaran yang menunggu verifikasi saat ini.</p>
        @else
            {{-- Tabel Pendaftaran --}}
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-6">Nama Mahasiswa</th>
                            <th scope="col" class="py-3 px-6">NIM</th>
                            <th scope="col" class="py-3 px-6">Prodi</th>
                            <th scope="col" class="py-3 px-6">Tgl Daftar</th>
                            <th scope="col" class="py-3 px-6">IPK / IPS</th>
                            <th scope="col" class="py-3 px-6">Toga</th>
                            <th scope="col" class="py-3 px-6">Nama Ortu</th>
                            <th scope="col" class="py-3 px-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $reg)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $reg->user->name ?? 'N/A' }} {{-- Akses nama dari relasi user --}}
                            </th>
                            <td class="py-4 px-6">
                                {{ $reg->user->nim ?? 'N/A' }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $reg->user->major ?? 'N/A' }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $reg->created_at->format('d M Y') }}
                            </td>
                             <td class="py-4 px-6">
                                {{ $reg->ipk }} / {{ $reg->ips }}
                            </td>
                             <td class="py-4 px-6">
                                {{ $reg->toga_size }}
                            </td>
                             <td class="py-4 px-6">
                                {{ $reg->parent_name }}
                            </td>
                            <td class="py-4 px-6 flex space-x-2">
                                {{-- Form untuk Verifikasi --}}
                                <form action="{{ route('admin.verification.update', $reg->id) }}" method="POST" onsubmit="return confirm('Verifikasi pendaftaran ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="verify">
                                    <button type="submit" class="font-medium text-green-600 hover:underline">Verifikasi</button>
                                </form>
                                {{-- Form untuk Tolak --}}
                                <form action="{{ route('admin.verification.update', $reg->id) }}" method="POST" onsubmit="return confirm('Tolak pendaftaran ini?')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="font-medium text-red-600 hover:underline">Tolak</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Tampilkan link pagination --}}
            <div class="mt-4">
                {{ $registrations->links() }}
            </div>
        @endif
    </div>
@endsection

