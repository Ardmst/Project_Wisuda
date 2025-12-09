<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Biodata Wisudawan - {{ $user->name }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; margin: 40px; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        
        /* Layout Tabel Data */
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        td { padding: 6px; vertical-align: top; }
        .label { width: 180px; font-weight: bold; }
        .separator { width: 10px; }

        /* KOTAK FOTO YANG DIPERBAIKI */
        .photo-container {
            position: relative;
            height: 160px; /* Siapkan ruang tinggi biar foto ga nabrak */
            margin-bottom: 20px;
        }
        .header-title {
            text-align: center;
            padding-top: 20px;
        }
        .photo-box { 
            width: 3cm; 
            height: 4cm; 
            border: 1px solid #000; 
            /* Posisi Absolut tapi relatif terhadap container ini */
            position: absolute; 
            top: 0; 
            right: 0; 
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10pt;
            background: #fff;
        }

        @media print { 
            @page { size: A4 portrait; margin: 2cm; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="text-center">
        <h3 style="margin:0">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h3>
        <h2 style="margin:5px 0">UNIVERSITAS SEBELAS MARET</h2>
        <p style="margin:0; font-size:14px">Kentingan Jl. Ir. Sutami No.36, Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126</p>
        <hr style="border: 2px solid black; margin-top: 10px;">
    </div>

    <br>

    <div class="photo-container">
        <div class="header-title">
            <h3 class="uppercase" style="text-decoration: underline; margin: 0;">BIODATA PESERTA WISUDA</h3>
            <p style="margin-top: 5px;">Periode X Tahun 2025</p>
        </div>

        <div class="photo-box">
            FOTO<br>3 x 4
        </div>
    </div>

    <table>
        <tr>
            <td class="label">NAMA LENGKAP</td>
            <td class="separator">:</td>
            <td class="bold uppercase">{{ $user->name }}</td>
        </tr>
        <tr>
            <td class="label">NIM</td>
            <td class="separator">:</td>
            <td>{{ $user->nim ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">FAKULTAS</td>
            <td class="separator">:</td>
            <td>{{ $user->faculty ?? 'Keguruan dan Ilmu Pendidikan' }}</td>
        </tr>
        <tr>
            <td class="label">PROGRAM STUDI</td>
            <td class="separator">:</td>
            <td>{{ $user->major }}</td>
        </tr>
        <tr>
            <td class="label">JUDUL SKRIPSI</td>
            <td class="separator">:</td>
            <td>{{ $data->thesis_title }}</td>
        </tr>
        <tr>
            <td class="label">IPK</td>
            <td class="separator">:</td>
            <td>{{ $data->ipk }}</td>
        </tr>
        <tr>
            <td class="label">NAMA ORANG TUA</td>
            <td class="separator">:</td>
            <td>{{ $data->parent_name }}</td>
        </tr>
    </table>

    <br><br>

    <div style="float: right; width: 250px; text-align: center;">
        <p>Surakarta, {{ date('d F Y') }}</p>
        <p>Mahasiswa Yang Bersangkutan,</p>
        <br><br><br><br>
        <p class="bold" style="text-decoration: underline;">{{ $user->name }}</p>
        <p>NIM. {{ $user->nim ?? '..................' }}</p>
    </div>

</body>
</html>