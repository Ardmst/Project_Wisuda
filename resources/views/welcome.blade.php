<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Wisuda - Universitas Sebelas Maret</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body 
    class="antialiased bg-gray-100"
    x-data="pageData()"
    @keydown.escape.window="closeModal()"
>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-center pt-8 pb-12">
            <div class="text-center md:text-left mb-8 md:mb-0">
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800">Sistem Wisuda</h1>
                <p class="text-2xl md:text-3xl font-semibold text-blue-600 mt-2">Universitas Sebelas Maret</p>
                <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white font-bold py-3 px-6 rounded-lg mt-8 hover:bg-blue-700 transition duration-300 text-lg">
                    LOGIN <i class="fa-solid fa-arrow-right-long ml-2"></i>
                </a>
            </div>
            <div>
                 <img src="{{ asset('images/graduatehat.webp') }}" alt="Topi Wisuda" class="w-56 h-56 md:w-72 md:h-72 object-contain">
            </div>
        </header>

        <!-- Main Content Section -->
        <main class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Pengumuman Section (Left) -->
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center border-b pb-4 mb-4">
                    <h2 class="text-lg font-bold text-gray-800">WISUDA PERIODE X TAHUN 2025 (TGL 29-11-2025)</h2>
                    <span class="bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full">Tutup</span>
                </div>

                <div class="space-y-6">
                    <!-- Pengumuman item -->
                    <div class="flex items-start">
                        <div class="bg-purple-100 p-3 rounded-lg mr-4">
                            <i class="fa-solid fa-volume-high text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-700">Pengumuman</h3>
                            <p class="text-sm text-gray-600 mt-1">Verifikasi wisuda tanggal 15 Oktober 2025 mulai pukul 08.00 wib s/d 20 Oktober 2025 pukul 15.00 wib. Pendaftaran oleh mahasiswa 15 s/d 21 Oktober 2025 pukul 15.00 wib dengan kuota 1.400 peserta.</p>
                        </div>
                    </div>
                    <!-- Info Jadwal item -->
                    <div class="flex items-start">
                        <div class="bg-orange-100 p-3 rounded-lg mr-4">
                            <i class="fa-solid fa-calendar-days text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-700">Info Jadwal</h3>
                            <p class="text-sm text-gray-600 mt-1">Wisudawan WAJIB mengumpulkan berkas wisuda tanggal 20 s/d 24 Oktober 2025 di Akademik Universitas</p>
                        </div>
                    </div>
                     <!-- Keterangan item -->
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-3 rounded-lg mr-4">
                            <i class="fa-solid fa-circle-info text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-700">Keterangan</h3>
                            <p class="text-sm text-gray-600 mt-1">Wisuda Periode X DILAKSANAKAN tanggal 29 November 2025. Calon Wisudawan WAJIB bergabung di Grup Telegram dan mengambil TOGA di akademik pusat. TANPA BERKAS IJAZAH DIPROSES BERDASARKAN DATA DI SIAKAD</p>
                        </div>
                    </div>
                    <!-- Telegram item -->
                    <div class="flex items-start">
                        <div class="bg-sky-100 p-3 rounded-lg mr-4">
                           <i class="fa-brands fa-telegram text-sky-600"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-700">Telegram</h3>
                             <a href="#" class="inline-block bg-sky-500 text-white text-xs font-bold py-1 px-3 rounded-md mt-2 hover:bg-sky-600 transition duration-300">
                                Join Group <i class="fa-solid fa-arrow-up-right-from-square ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Section (Right) -->
            <div class="bg-white text-gray-800 p-6 rounded-lg shadow-md">
                 <h2 class="text-lg font-bold border-b border-gray-200 pb-2 mb-4">Informasi Persiapan Peserta Wisuda</h2>
                 <div class="grid grid-cols-2 gap-4 mt-6">
                    <button @click="openAlurModal()" class="bg-yellow-400 text-white p-4 rounded-lg text-center hover:bg-yellow-500 transition duration-300">
                        <i class="fa-solid fa-file-lines fa-2x mb-2"></i>
                        <span class="text-sm font-semibold block">Alur Pendaftaran</span>
                    </button>
                    <a href="https://cdnb.uns.ac.id/wisuda/public/alurwisuda.pdf" target="_blank" class="bg-blue-400 text-white p-4 rounded-lg text-center hover:bg-blue-500 transition duration-300 flex flex-col justify-center items-center">
                        <i class="fa-solid fa-book-open fa-2x mb-2"></i>
                        <span class="text-sm font-semibold block">Panduan Wisuda</span>
                    </a>
                    <a href="https://cdnb.uns.ac.id/wisuda/public/videopanduan.mp4" target="_blank" class="bg-green-400 text-white p-4 rounded-lg text-center hover:bg-green-500 transition duration-300 flex flex-col justify-center items-center">
                        <i class="fa-solid fa-video fa-2x mb-2"></i>
                        <span class="text-sm font-semibold block">Video Panduan</span>
                    </a>
                     <button @click="openLaguModal()" class="bg-cyan-400 text-white p-4 rounded-lg text-center hover:bg-cyan-500 transition duration-300">
                        <i class="fa-solid fa-music fa-2x mb-2"></i>
                        <span class="text-sm font-semibold block">Lagu Terimakasih</span>
                    </button>
                 </div>
            </div>
        </main>
    </div>

    <!-- == MODALS CONTAINER == -->
    <div
        x-show="activeModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
        style="display: none;"
    >
        <!-- Modal Alur Pendaftaran -->
        <div x-show="activeModal === 'alur'" @click.away="closeModal()" class="bg-slate-800 rounded-lg shadow-xl w-full max-w-3xl mx-4">
            <div class="p-6">
                <div class="flex justify-between items-center border-b border-slate-600 pb-3 mb-4">
                    <h3 class="text-xl font-semibold text-white">Alur Pendaftaran Wisuda</h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-white">
                        <i class="fa-solid fa-xmark fa-2x"></i>
                    </button>
                </div>
                <!-- Tabs -->
                <div class="flex border-b border-slate-600">
                    <button @click="alurStep = 1" :class="{'border-teal-500 text-teal-500': alurStep === 1, 'border-transparent text-gray-400 hover:text-white hover:border-gray-500': alurStep !== 1}" class="w-1/4 py-3 text-sm font-medium border-b-2 transition">Tahap 1</button>
                    <button @click="alurStep = 2" :class="{'border-teal-500 text-teal-500': alurStep === 2, 'border-transparent text-gray-400 hover:text-white hover:border-gray-500': alurStep !== 2}" class="w-1/4 py-3 text-sm font-medium border-b-2 transition">Tahap 2</button>
                    <button @click="alurStep = 3" :class="{'border-teal-500 text-teal-500': alurStep === 3, 'border-transparent text-gray-400 hover:text-white hover:border-gray-500': alurStep !== 3}" class="w-1/4 py-3 text-sm font-medium border-b-2 transition">Tahap 3</button>
                    <button @click="alurStep = 4" :class="{'border-teal-500 text-teal-500': alurStep === 4, 'border-transparent text-gray-400 hover:text-white hover:border-gray-500': alurStep !== 4}" class="w-1/4 py-3 text-sm font-medium border-b-2 transition">Tahap 4</button>
                </div>
                <!-- Content -->
                <div class="py-5 text-gray-300 text-sm">
                    <div x-show="alurStep === 1">
                        <h4 class="font-bold text-teal-400 mb-3">Mahasiswa menyerahkan berkas ke Fakultas/Sekolah Pascasarjana/Sekolah Vokasi berupa :</h4>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Surat Keterangan Lulus (SKL)</li>
                            <li>Fotocopy Ijazah Sebelumnya (SMU/SMK/Diploma/S1/S2)</li>
                            <li>Fotocopy Kutipan Akta Lahir</li>
                            <li>Kwitansi pembayaran SPP Semester terakhir ketika mahasiswa dinyatakan lulus</li>
                            <li>Fotocopy Sertifikat TOEFL/EAP dari UPT Bahasa</li>
                            <li>Fotocopy tanda bukti publikasi artikel/jurnal ilmiah</li>
                            <li>Pasfoto hitam putih ukuran 3x4 sebanyak 2 lembar</li>
                        </ul>
                    </div>
                    <div x-show="alurStep === 2">
                        <h4 class="font-bold text-teal-400 mb-3">Petugas Fakultas/Sekolah Pascasarjana/Sekolah Vokasi</h4>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Menerima berkas persyaratan wisuda</li>
                            <li>Memverifikasi data dan dokumen mahasiswa (memastikan kesamaan nama, tempat lahir, tanggal lahir, NIK di semua dokumen mahasiswa)</li>
                            <li>Memverifikasi data pelaporan mahasiswa di PDDIKTI (memastikan bahwa pelaporan ke PDDIKTI sudah lengkap sampai dengan mahasiswa tersebut dinyatakan lulus)</li>
                            <li>Memastikan mahasiswa sudah memiliki nomor ijazah nasional dari Dikti</li>
                            <li>Bila data/dokumen dinyatakan valid dan lengkap dan mahasiswa sudah memiliki nomor ijazah nasional, admin akademik prodi atau fakultas melakukan verifikasi wisuda di web wisuda.uns.ac.id (sesuai jadwal pendaftaran wisuda) dan memberikan kode akses wisuda kepada calon wisudawan</li>
                        </ul>
                    </div>
                    <div x-show="alurStep === 3">
                        <h4 class="font-bold text-teal-400 mb-3">Pendaftaran online wisuda</h4>
                        <ul class="list-disc list-inside space-y-2">
                            <li>Mahasiswa login di web wisuda.uns.ac.id dengan menggunakan SSO</li>
                            <li>Mahasiswa mengupload foto hitam putih dengan format JPG atau JPEG ukuran maksimal 100 kb di web wisuda.uns.ac.id dengan login NIM dan password menggunakan kode akses yang didapat dari akademik fakultas</li>
                            <li>Memastikan kebenaran data yang diisikan sebelum melakukan submit/penyimpanan</li>
                            <li>Melakukan sinkronisasi data dengan klik sinkron data di web wisuda.uns.ac.id</li>
                            <li>Cetak draft ijazah</li>
                        </ul>
                    </div>
                    <div x-show="alurStep === 4">
                        <h4 class="font-bold text-teal-400 mb-3">Mahasiswa menyerahkan berkas ke Akademik Pusat</h4>
                         <ul class="list-disc list-inside space-y-2">
                            <li>Print out draft ijazah</li>
                            <li>Surat Keterangan Lulus</li>
                            <li>Fotocopy KTP</li>
                            <li>Fotocopy Kutipan Akta Lahir</li>
                            <li>Fotocopy ijazah pendidikan jenjang sebelumnya</li>
                            <li>Pasfoto hitam putih dop ukuran 3x4 sebanyak 2 lembar sesuai ketentuan</li>
                        </ul>
                    </div>
                </div>
                <div class="flex justify-end pt-4 border-t border-slate-600">
                    <button @click="closeModal()" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Close</button>
                </div>
            </div>
        </div>

        <!-- Modal Lagu -->
        <div x-show="activeModal === 'lagu'" @click.away="closeModal()" class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
             <div class="p-6">
                <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Syair lagu Terima Kasih UNS</h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-xmark fa-2x"></i>
                    </button>
                </div>
                <div class="py-4">
                    <button @click="togglePlay()" class="w-full flex items-center justify-center py-2 px-4 rounded-md text-white transition-colors" :class="isPlaying ? 'bg-orange-500 hover:bg-orange-600' : 'bg-teal-500 hover:bg-teal-600'">
                        <i class="fas" :class="isPlaying ? 'fa-pause mr-2' : 'fa-play mr-2'"></i>
                        <span x-text="isPlaying ? 'Jeda Lagu' : 'Mainkan Lagu'"></span>
                    </button>
                    <div class="mt-5 text-gray-600 text-center leading-relaxed">
                        <p>Trima kasihku UNS ku</p>
                        <p>Jasamu akan kuingat slalu</p>
                        <p>Kan kubaktikan bekal ilmu darimu</p>
                        <p>Kami bercita kan selalu singsingkan lengan baju dan maju</p>
                        <p>Bangun Indonesiaku</p>
                        <p>Mangesti luhur bangun nagri</p>
                        <p>Baktikan diriku tuk ibu pertiwi</p>
                        <p>Doa restumu untuk-ku</p>
                    </div>
                </div>
                 <div class="flex justify-end pt-4 border-t border-gray-200">
                    <button @click="closeModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function pageData() {
            return {
                activeModal: null,
                alurStep: 1,
                isPlaying: false,
                audio: new Audio('https://cdnb.uns.ac.id/wisuda/public/lagu-terimakasih-uns.mp3'),

                openAlurModal() {
                    this.activeModal = 'alur';
                    this.alurStep = 1;
                },
                openLaguModal() {
                    this.activeModal = 'lagu';
                },
                closeModal() {
                    if (this.activeModal === 'lagu' && this.isPlaying) {
                        this.audio.pause();
                        this.audio.currentTime = 0;
                        this.isPlaying = false;
                    }
                    this.activeModal = null;
                },
                togglePlay() {
                    if (this.isPlaying) {
                        this.audio.pause();
                    } else {
                        this.audio.play();
                    }
                    this.isPlaying = !this.isPlaying;
                },
                init() {
                    this.audio.addEventListener('ended', () => {
                        this.isPlaying = false;
                        this.audio.currentTime = 0;
                    });
                }
            }
        }
    </script>
</body>
</html>

