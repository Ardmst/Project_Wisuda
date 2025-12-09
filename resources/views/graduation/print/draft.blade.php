<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Draft Ijazah - {{ $user->name }}</title>
    <style>
        /* Reset Default Browser */
        * { box-sizing: border-box; }
        
        body { 
            font-family: 'Times New Roman', serif; 
            text-align: center; 
            margin: 0; 
            padding: 0;
            background-color: #fff;
        }

        /* Container Utama dengan Border Ganda */
        .border-ijazah {
            width: 100%;
            height: 100vh; /* Paksa tinggi seukuran layar/kertas */
            border: 5px double #000; /* Border Ijazah */
            padding: 30px; /* Jarak border ke teks */
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Tengahkan isi secara vertikal */
        }

        /* Typography yang lebih hemat tempat */
        h1 { 
            font-family: 'Times New Roman', serif; 
            font-size: 24pt; 
            margin: 5px 0; 
            text-transform: uppercase; 
            letter-spacing: 2px;
        }
        h2 { 
            font-size: 16pt; 
            margin: 5px 0; 
            font-weight: bold; 
        }
        p { 
            font-size: 12pt; 
            margin: 3px 0; 
        }
        
        /* Nama Mahasiswa */
        .name { 
            font-family: 'Monotype Corsiva', cursive; 
            font-size: 32pt; /* Sedikit dikecilkan biar aman */
            font-weight: bold; 
            margin: 15px 0; 
            text-decoration: underline;
        }

        /* Watermark Background */
        .watermark {
            position: absolute; 
            top: 50%; left: 50%; 
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 80pt; 
            color: rgba(0,0,0,0.03); 
            z-index: -1; 
            font-weight: bold; 
            border: 5px solid rgba(0,0,0,0.03);
            padding: 10px 40px;
            pointer-events: none;
        }

        /* Pengaturan Khusus Cetak */
        @media print { 
            @page { 
                size: A4 landscape; /* Paksa Landscape */
                margin: 0; /* Hilangkan margin browser */
            }
            body { margin: 0; -webkit-print-color-adjust: exact; }
            .border-ijazah { 
                height: 100vh; 
                border: 10px double #000; /* Pertebal border saat print */
                margin: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="border-ijazah">
        <div class="watermark">DRAFT SEMENTARA</div>

        {{-- Header Kementerian (Disesuaikan Alamat Baru) --}}
        <p style="margin-top: 0;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</p>
        <h1>UNIVERSITAS SEBELAS MARET</h1>
        <p style="font-size: 10pt;">Kentingan Jl. Ir. Sutami No.36, Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126</p>
        
        <br>

        <p>Memberikan Ijazah Kepada:</p>

        <div class="name">{{ strtoupper($user->name) }}</div>
        <p>NIM: {{ $user->nim ?? 'M00000000' }}</p>

        <br>

        <p>Telah menyelesaikan program pendidikan Sarjana pada Program Studi:</p>
        <h2 style="text-transform: uppercase;">{{ $user->major }}</h2>
        
        <p>Sehingga kepadanya diberikan gelar akademik:</p>
        <h2>SARJANA PENDIDIKAN (S.Pd.)</h2>
        {{-- Nanti bisa dibuat dinamis sesuai Prodi jika mau --}}

        <br><br>

        <p>Diberikan di Surakarta pada tanggal {{ date('d F Y') }}</p>

        <div style="display: flex; justify-content: space-around; margin-top: 40px;">
            <div style="text-align: center; width: 300px;">
                <p>DEKAN</p>
                <br><br><br><br> <p style="font-weight: bold; border-bottom: 1px solid black; display: inline-block; width: 200px;"> </p>
                <p>NIP. ........................................</p>
            </div>
            <div style="text-align: center; width: 300px;">
                <p>REKTOR</p>
                <br><br><br><br> <p style="font-weight: bold; border-bottom: 1px solid black; display: inline-block; width: 200px;"> </p>
                <p>NIP. ........................................</p>
            </div>
        </div>
    </div>

</body>
</html>