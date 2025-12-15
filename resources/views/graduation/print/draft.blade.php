<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Draft Verifikasi Ijazah</title>
    <style>
        /* --- 1. SETUP KERTAS (KUNCI UTAMA) --- */
        @page { 
            size: A4 landscape; 
            margin: 0; /* Wajib 0 agar tidak ada margin ganda */
        }
        
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            background: #fff;
            -webkit-print-color-adjust: exact;
        }

        /* --- 2. CONTAINER (LOGIKA BIODATA) --- */
        /* Kita TIDAK set width. Kita hanya set Padding.
           Biarkan browser yang menghitung sisa ruangnya. */
        .page-wrapper {
            padding: 15mm 20mm; /* Atas-Bawah 15mm, Kiri-Kanan 20mm */
            box-sizing: border-box; 
        }

        /* --- 3. ELEMENT STYLING --- */
        .watermark {
            position: fixed; /* Pakai fixed biar tidak ganggu layout */
            top: 50%; left: 50%;
            transform: translate(-50%, -50%) rotate(-20deg);
            font-size: 80pt;
            font-weight: bold;
            color: rgba(0, 0, 0, 0.05); 
            border: 5px solid rgba(0, 0, 0, 0.05);
            padding: 10px 40px;
            z-index: -1;
            pointer-events: none;
        }

        /* Header diperkecil sedikit karena Landscape pendek secara vertikal */
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 5px;
            margin-bottom: 15px; 
        }
        .header h2 { margin: 0; font-size: 16pt; text-transform: uppercase; }
        .header p { margin: 0; font-size: 10pt; font-style: italic; }

        .doc-title {
            text-align: center;
            font-weight: bold;
            font-size: 14pt;
            text-decoration: underline;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        /* --- 4. GRID LAYOUT (2 KOLOM) --- */
        .grid-container {
            display: table; /* Teknik Tabel CSS (Lebih aman dari Flexbox untuk PDF jadul) */
            width: 100%;
            border-collapse: collapse;
        }
        .grid-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .col-left { padding-right: 15px; border-right: 1px dashed #bbb; }
        .col-right { padding-left: 15px; }

        /* Style Tabel Data */
        .sub-header {
            font-weight: bold;
            background: #eee;
            padding: 5px;
            border: 1px solid #000;
            font-size: 10pt;
            margin-bottom: 8px;
        }
        
        .info-table { width: 100%; font-size: 10pt; }
        .info-table td { padding: 3px 0; vertical-align: top; }
        .lbl { width: 30%; color: #444; }
        .sep { width: 3%; text-align: center; }
        .val { width: 67%; font-weight: bold; color: #000; }

        /* --- 5. FOOTER & TTD --- */
        .footer-box {
            margin-top: 15px; /* Jarak dari konten atas */
            border: 2px solid #000;
            padding: 10px;
            page-break-inside: avoid; /* Jangan sampai terpotong ke hal 2 */
        }
        .ttd-table { width: 100%; text-align: center; font-size: 10pt; margin-top: 10px; }
        .ttd-space { height: 50px; } /* Space Tanda Tangan */

    </style>
</head>
<body onload="window.print()">

    <div class="watermark">DRAFT VALIDASI</div>

    <div class="page-wrapper">
        
        {{-- KOP SURAT --}}
        <div class="header">
            <h2>Universitas Sebelas Maret</h2>
            <p>Jalan Ir. Sutami No. 36A, Surakarta, Jawa Tengah 57126</p>
        </div>

        <div class="doc-title">LEMBAR VERIFIKASI DATA IJAZAH (DRAFT)</div>

        {{-- LAYOUT 2 KOLOM --}}
        <div class="grid-container">
            
            {{-- KOLOM KIRI --}}
            <div class="grid-col col-left">
                <div class="sub-header">A. DATA PRIBADI</div>
                <table class="info-table">
                    <tr><td class="lbl">Nama Lengkap</td><td class="sep">:</td><td class="val">{{ $user->name }}</td></tr>
                    <tr><td class="lbl">NIM</td><td class="sep">:</td><td class="val">{{ $user->nim ?? '-' }}</td></tr>
                    <tr><td class="lbl">Tempat Lahir</td><td class="sep">:</td><td class="val">{{ $user->birth_place ?? 'Jakarta' }}</td></tr>
                    <tr><td class="lbl">Tanggal Lahir</td><td class="sep">:</td><td class="val">{{ $user->birth_date ?? '01-01-2000' }}</td></tr>
                    <tr><td class="lbl">NIK</td><td class="sep">:</td><td class="val">{{ $user->nik ?? '-' }}</td></tr>
                </table>
            </div>

            {{-- KOLOM KANAN --}}
            <div class="grid-col col-right">
                <div class="sub-header">B. DATA AKADEMIK</div>
                <table class="info-table">
                    <tr><td class="lbl">Fakultas</td><td class="sep">:</td><td class="val">{{ $user->faculty ?? 'Teknik' }}</td></tr>
                    <tr><td class="lbl">Program Studi</td><td class="sep">:</td><td class="val">{{ $user->major ?? 'Informatika' }}</td></tr>
                    <tr><td class="lbl">IPK Terakhir</td><td class="sep">:</td><td class="val">{{ $user->ipk ?? '0.00' }}</td></tr>
                    <tr><td class="lbl">Tanggal Lulus</td><td class="sep">:</td><td class="val">{{ date('d F Y') }}</td></tr>
                    <tr>
                        <td class="lbl">Judul Skripsi</td><td class="sep">:</td>
                        <td class="val" style="font-weight: normal; font-style: italic;">
                            "Analisis Pengaruh Eligendi et eum pada Studi Kasus Sosiologi di Era Digital"
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        {{-- FOOTER VALIDASI --}}
        <div class="footer-box">
            <div style="font-size: 9pt; text-align: justify; margin-bottom: 5px;">
                <strong>PERHATIAN:</strong> Pastikan ejaan Nama, Gelar, Tempat & Tanggal Lahir sudah SESUAI dengan Ijazah SMA/Akte Kelahiran. Kesalahan data yang diketahui setelah proses cetak Ijazah Asli sepenuhnya menjadi tanggung jawab wisudawan.
            </div>

            <table class="ttd-table">
                <tr>
                    <td width="33%">
                        Menyetujui,<br>Mahasiswa Ybs
                        <div class="ttd-space"></div>
                        <strong><u>{{ $user->name }}</u></strong>
                    </td>
                    <td width="33%">
                        Verifikator,<br>Bagian Akademik
                        <div class="ttd-space"></div>
                        <strong>( ........................................ )</strong>
                    </td>
                    <td width="33%">
                        Mengetahui,<br>Kepala Program Studi
                        <div class="ttd-space"></div>
                        <strong>( ........................................ )</strong>
                    </td>
                </tr>
            </table>
        </div>

    </div>

</body>
</html>