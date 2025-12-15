<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GraduationRegistration;
use App\Models\Announcement;
use App\Models\GraduationPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Pakai Faker Indonesia
        
        // ==========================================
        // 0. DATA REFERENSI UNS (LENGKAP)
        // ==========================================
        $dataUNS = [
            'Fakultas Teknik' => [
                'Teknik Informatika', 'Teknik Sipil', 'Teknik Mesin', 'Arsitektur', 
                'Teknik Industri', 'Teknik Kimia', 'Perencanaan Wilayah dan Kota'
            ],
            'FKIP' => [
                'Pendidikan TIK', 'Pendidikan Bahasa Inggris', 'Pendidikan Matematika', 
                'PGSD', 'Pendidikan Sejarah', 'Pendidikan Luar Biasa', 'Bimbingan Konseling'
            ],
            'Fakultas Ekonomi dan Bisnis' => [
                'Akuntansi', 'Manajemen', 'Ekonomi Pembangunan', 'Bisnis Digital'
            ],
            'Fakultas Hukum' => [
                'Ilmu Hukum'
            ],
            'Fakultas Kedokteran' => [
                'Kedokteran', 'Psikologi', 'Kebidanan'
            ],
            'Fakultas Pertanian' => [
                'Agroteknologi', 'Agribisnis', 'Ilmu Tanah', 'Peternakan'
            ],
            'FISP' => [
                'Ilmu Komunikasi', 'Hubungan Internasional', 'Administrasi Negara', 'Sosiologi'
            ],
            'FMIPA' => [
                'Informatika', 'Matematika', 'Fisika', 'Biologi', 'Kimia', 'Statistika'
            ],
            'Fakultas Keolahragaan' => [
                'Pendidikan Jasmani', 'Kepelatihan Olahraga'
            ],
            'Fakultas Seni Rupa dan Desain' => [
                'Desain Komunikasi Visual', 'Kriya Seni', 'Seni Rupa Murni'
            ]
        ];

        // ==========================================
        // 1. DATA ADMIN (Fixed)
        // ==========================================
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@uns.ac.id', // Login pakai ini
            'password' => Hash::make('password'),
            'role' => 'admin',
            'nim' => 'ADMIN001',
            'faculty' => 'Administrator',
            'major' => 'Administrator',
            'cohort' => '2015',
            'semester' => 0,
            'status' => 'active',
        ]);

        // ==========================================
        // 2. PERIODE WISUDA
        // ==========================================
        $periode = GraduationPeriod::create([
            'name' => 'Periode IV - Desember 2025',
            'graduation_date' => '2025-12-20',
            'quota' => 1000, // Kuota gedein biar muat
            'status' => 'open',
            'description' => 'Wisuda Akbar Penutup Tahun',
        ]);

        Announcement::create([
            'title' => 'Simulasi Wisuda Besar-besaran',
            'content' => 'Sistem sedang diuji coba dengan 750 data mahasiswa.',
        ]);

        // ==========================================
        // 3. GENERATE 750 MAHASISWA
        // ==========================================
        $this->command->info('Sedang membuat 750 data mahasiswa UNS, mohon tunggu sebentar...');

        $fakultasKeys = array_keys($dataUNS); // Ambil daftar nama fakultas

        for ($i = 1; $i <= 750; $i++) {
            
            // A. Random Data Akademik
            $fakultasTerpilih = $faker->randomElement($fakultasKeys);
            $prodiTerpilih = $faker->randomElement($dataUNS[$fakultasTerpilih]);
            $angkatan = $faker->numberBetween(2017, 2025);
            
            // Hitung Semester (Asumsi saat ini tahun 2025 akhir)
            $lamaKuliahTahun = 2025 - $angkatan;
            $semester = ($lamaKuliahTahun * 2) + 1; 
            if ($semester > 14) $semester = 14; // Mentok semester 14

            // B. Buat User
            $user = User::create([
                'name' => $faker->name(),
                'email' => $faker->userName . $i . '@student.uns.ac.id', // Email unik
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'nim' => $this->generateNIM($fakultasTerpilih, $angkatan),
                'faculty' => $fakultasTerpilih,
                'major' => $prodiTerpilih,
                'cohort' => (string)$angkatan,
                'semester' => $semester,
                'status' => 'active',
            ]);

            // C. Logika Pendaftaran Wisuda
            // Hanya angkatan 2017-2021 yang PASTI daftar wisuda
            // Angkatan 2022 kemungkinannya 50:50
            // Angkatan 2023-2025 belum daftar (masih kuliah)
            
            $shouldRegister = false;
            $statusWisuda = 'pending';

            if ($angkatan <= 2021) {
                $shouldRegister = true;
                // Random status: Kebanyakan verified, ada yg rejected/pending dikit
                $statusWisuda = $faker->randomElement(['verified', 'verified', 'verified', 'pending', 'rejected']); 
            } elseif ($angkatan == 2022) {
                $shouldRegister = $faker->boolean(50); // 50% kemungkinan daftar
                $statusWisuda = 'pending'; // Baru daftar
            }

            // Jika memenuhi syarat, daftarkan ke tabel graduation_registrations
            if ($shouldRegister) {
                GraduationRegistration::create([
                    'user_id' => $user->id,
                    'graduation_period_id' => $periode->id,
                    'parent_name' => $faker->name($user->gender == 'male' ? 'male' : 'male'), // Nama Bapak
                    'toga_size' => $faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
                    'ipk' => $faker->randomFloat(2, 2.75, 4.00), // IPK realistis
                    'ips' => $faker->randomFloat(2, 2.50, 4.00),
                    'thesis_title' => $this->generateJudulSkripsi($prodiTerpilih),
                    'status' => $statusWisuda,
                ]);
            }
        }
    }

    // Helper function bikin NIM biar agak real (Contoh: M0519001)
    private function generateNIM($fakultas, $angkatan) {
        $prefix = match($fakultas) {
            'Fakultas Teknik' => 'I0',
            'FKIP' => 'K3',
            'Fakultas Ekonomi dan Bisnis' => 'F0',
            'FMIPA' => 'M0',
            'FISP' => 'D0',
            'Fakultas Hukum' => 'E0',
            default => 'X0'
        };
        $tahunDuaDigit = substr((string)$angkatan, -2);
        $randomDigit = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        return $prefix . rand(1,9) . $tahunDuaDigit . $randomDigit;
    }

    // Helper function judul skripsi random biar keren
    private function generateJudulSkripsi($prodi) {
        $faker = Faker::create('id_ID');
        $topik = $faker->words(3, true);
        return "Analisis Pengaruh " . ucfirst($topik) . " pada Studi Kasus " . $prodi . " di Era Digital";
    }
}