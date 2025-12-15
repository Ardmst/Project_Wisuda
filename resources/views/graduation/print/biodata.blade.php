<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Biodata Wisudawan - {{ $user->name }}</title>
    <style>
        @page { size: A4 portrait; margin: 0; }
        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'Times New Roman', serif; 
            color: #000;
        }

        /* Container Utama dengan Margin Halaman */
        .page-container {
            padding: 2cm 2.5cm; /* Margin standar dokumen resmi */
        }

        /* Kop Surat Sederhana */
        .kop-surat {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .kop-surat h3 { margin: 0; font-size: 14pt; font-weight: normal; }
        .kop-surat h2 { margin: 5px 0; font-size: 16pt; font-weight: bold; }
        .kop-surat p { margin: 0; font-size: 10pt; font-style: italic; }

        /* Header Judul & Foto */
        .header-section {
            position: relative;
            margin-bottom: 30px;
            height: 160px; /* Ruang untuk foto */
        }
        .title-text {
            text-align: center;
            padding-top: 20px;
        }
        .title-text h1 {
            font-size: 16pt;
            text-decoration: underline;
            margin: 0;
            text-transform: uppercase;
        }
        .photo-box {
            position: absolute;
            top: 0;
            right: 0;
            width: 3cm;
            height: 4cm;
            border: 1px solid #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10pt;
            text-align: center;
        }

        /* Tabel Data */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
        }
        .data-table td {
            padding: 6px 0;
            vertical-align: top;
        }
        .label { font-weight: bold; width: 35%; }
        .sep { width: 3%; }
        .val { width: 62%; }

        /* Footer Tanda Tangan */
        .footer-section {
            margin-top: 50px;
            float: right;
            width: 250px;
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="page-container">
        
        {{-- KOP --}}
        <div class="kop-surat">
            <h3>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h3>
            <h2>UNIVERSITAS SEBELAS MARET</h2>
            <p>Kentingan Jl. Ir. Sutami No.36, Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126</p>
        </div>

        {{-- JUDUL & FOTO --}}
        <div class="header-section">
            <div class="title-text">
                <h1>BIODATA PESERTA WISUDA</h1>
                <p>Periode IV Tahun 2025</p>
            </div>
            <div class="photo-box">
                FOTO<br>3 x 4
            </div>
        </div>

        {{-- TABEL DATA --}}
        <table class="data-table">
            <tr>
                <td class="label">NAMA LENGKAP</td>
                <td class="sep">:</td>
                <td class="val"><strong>{{ strtoupper($user->name) }}</strong></td>
            </tr>
            <tr>
                <td class="label">NIM</td>
                <td class="sep">:</td>
                <td class="val">{{ $user->nim }}</td>
            </tr>
            <tr>
                <td class="label">FAKULTAS</td>
                <td class="sep">:</td>
                {{-- PERBAIKAN: Menggunakan Accessor nama_fakultas --}}
                <td class="val" style="text-transform: uppercase;">{{ $user->nama_fakultas }}</td>
            </tr>
            <tr>
                <td class="label">PROGRAM STUDI</td>
                <td class="sep">:</td>
                <td class="val">{{ $user->major }}</td>
            </tr>
            <tr>
                <td class="label">JUDUL SKRIPSI</td>
                <td class="sep">:</td>
                <td class="val" style="text-align: justify;">{{ $registration->thesis_title }}</td>
            </tr>
            <tr>
                <td class="label">IPK</td>
                <td class="sep">:</td>
                <td class="val">{{ $registration->ipk }}</td>
            </tr>
            <tr>
                <td class="label">NAMA ORANG TUA</td>
                <td class="sep">:</td>
                <td class="val">{{ $registration->parent_name }}</td>
            </tr>
        </table>

        {{-- TANDA TANGAN --}}
        <div class="footer-section">
            <p>Surakarta, {{ date('d F Y') }}</p>
            <p>Mahasiswa Yang Bersangkutan,</p>
            <br><br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">{{ $user->name }}</p>
            <p>NIM. {{ $user->nim }}</p>
        </div>

    </div>

</body>
</html>