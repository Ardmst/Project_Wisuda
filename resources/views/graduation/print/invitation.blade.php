<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Undangan Wisuda - {{ $user->name }}</title>
    <style>
        /* 1. Setup Halaman A4 Portrait Nol Margin */
        @page { 
            size: A4 portrait; 
            margin: 0; 
        }
        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'Times New Roman', serif; 
            background: #fff; 
            color: #000; 
        }

        /* 2. Bingkai/Border (Fixed Position) - Anti Geser/Potong */
        .border-frame {
            position: fixed;
            top: 15px; 
            bottom: 15px; 
            left: 15px; 
            right: 15px;
            border: 5px double #000;
            z-index: 10;
            pointer-events: none; /* Agar tidak menghalangi seleksi teks */
        }

        /* 3. Wrapper Konten (Absolute di dalam border) */
        .content-wrapper {
            position: absolute;
            top: 20px; 
            left: 20px; 
            right: 20px; 
            bottom: 20px;
            padding: 20px 40px; /* Jarak aman dari border ke teks */
        }

        /* 4. Styling Header */
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        .address {
            font-size: 10pt;
            font-style: italic;
            margin-top: 5px;
        }

        /* 5. Typography */
        h1 {
            text-align: center;
            font-size: 22pt;
            letter-spacing: 3px;
            margin: 20px 0;
            text-decoration: underline;
        }
        p {
            font-size: 12pt;
            line-height: 1.4;
            margin-bottom: 8px;
        }
        .text-justify { text-align: justify; }
        .highlight { font-weight: bold; font-size: 13pt; }

        /* 6. Tabel Detail */
        .details-table {
            margin: 15px 0;
            width: 100%;
            font-size: 12pt;
            border-collapse: collapse;
        }
        .details-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        /* 7. Footer */
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12pt;
            padding-right: 20px;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="border-frame"></div>

    <div class="content-wrapper">
        
        {{-- KOP SURAT --}}
        <div class="header">
            <div class="logo">UNIVERSITAS SEBELAS MARET</div>
            <div class="address">Jalan Ir. Sutami No. 36A, Surakarta, Jawa Tengah 57126</div>
        </div>

        <h1>UNDANGAN</h1>

        <div class="text-justify">
            <p>Kepada Yth.,</p>
            {{-- Nama Orang Tua --}}
            <p class="highlight">Bapak/Ibu {{ $registration->parent_name }}</p>
            <p>Orang Tua/Wali dari Wisudawan: <strong>{{ $user->name }}</strong></p>
            
            <br>
            
            <p>Dengan hormat,</p>
            <p>Mengharap kehadiran Bapak/Ibu pada Upacara Wisuda Periode IV Universitas Sebelas Maret yang akan diselenggarakan pada:</p>

            <table class="details-table">
                <tr>
                    <td width="25%">Hari, Tanggal</td>
                    <td width="5%">:</td>
                    <td><strong>Sabtu, 20 Desember 2025</strong></td> 
                </tr>
                <tr>
                    <td>Pukul</td>
                    <td>:</td>
                    <td>07.30 WIB - Selesai</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td>Auditorium G.P.H. Haryo Mataram UNS</td>
                </tr>
                <tr>
                    <td>Nomor Kursi</td>
                    <td>:</td>
                    <td><strong>{{ strtoupper(substr($user->faculty ?? 'A', 0, 1)) }}-{{ rand(1, 100) }}</strong></td>
                </tr>
            </table>

            <br>
            <p>Mengingat pentingnya acara ini, dimohon hadir 30 menit sebelum acara dimulai. Undangan ini wajib dibawa saat memasuki lokasi wisuda.</p>
        </div>

        <div class="footer">
            <p>Surakarta, {{ date('d F Y') }}</p>
            <br><br><br>
            <p><strong>Panitia Wisuda</strong></p>
        </div>

    </div>

</body>
</html>