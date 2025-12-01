<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Wisuda</title>
    <style>
        /* CSS SEDERHANA KHUSUS PRINT */
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        .mb-4 { margin-bottom: 1rem; }
        
        /* Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        
        /* Agar Header Tabel muncul di tiap halaman kalau datanya banyak */
        thead { display: table-header-group; }
        tr { page-break-inside: avoid; }

        /* Tanda Tangan (Opsional) */
        .signature { margin-top: 50px; float: right; width: 200px; text-align: center; }
    </style>
</head>
<body onload="window.print()">

    <div class="text-center mb-4">
        {{-- Ganti path logo sesuai kebutuhan, atau hapus img tag jika error gambar --}}
        {{-- <img src="{{ asset('images/uns.webp') }}" style="height: 80px;"> --}}
        <h3 style="margin: 0;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h3>
        <h2 style="margin: 5px 0;">UNIVERSITAS SEBELAS MARET</h2>
        <p style="margin: 0;">Jalan Ir. Sutami 36A, Surakarta 57126</p>
        <hr style="border: 1px solid black; margin-top: 10px;">
    </div>

    <h3 class="text-center">LAPORAN DATA WISUDAWAN</h3>
    
    @if(request('prodi'))
        <p><strong>Program Studi:</strong> {{ request('prodi') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
                <th>Angkatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $mhs)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $mhs->name }}</td>
                <td>{{ $mhs->nim ?? '-' }}</td>
                <td>{{ $mhs->major }}</td>
                <td>{{ $mhs->cohort }}</td>
                <td class="text-center">{{ ucfirst($mhs->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature">
        <p>Surakarta, {{ date('d F Y') }}</p>
        <p>Kepala Biro Akademik,</p>
        <br><br><br>
        <p><strong>Nama Pejabat</strong></p>
        <p>NIP. 19800101 200001 1 001</p>
    </div>

</body>
</html>