<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\GraduationRegistration; // Pastikan model ini di-import

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',     // admin / mahasiswa
        'nim',      
        'faculty',  
        'major',    
        'cohort',   // angkatan
        'semester',
        'status',   // aktif / lulus
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Accessors (Helpers)
    |--------------------------------------------------------------------------
    */

    /**
     * Helper 1: Mendapatkan Gelar Singkat (S.Pd., S.Kom., dll)
     * Dipanggil dengan: $user->gelar
     */
    public function getGelarAttribute()
    {
        $major = strtolower($this->major ?? '');
        $faculty = strtolower($this->faculty ?? '');

        // 1. Cek Kependidikan (Prioritas Tertinggi untuk PTIK/FKIP)
        if (str_contains($major, 'pendidikan') || str_contains($faculty, 'fkip')) {
            return 'S.Pd.';
        }

        // 2. Cek Hukum
        if (str_contains($major, 'hukum')) {
            return 'S.H.';
        }

        // 3. Cek Ekonomi
        if (str_contains($major, 'ekonomi') || str_contains($major, 'akuntansi') || str_contains($major, 'manajemen')) {
            return 'S.E.';
        }

        // 4. Cek Pertanian (Ditaruh sebelum Teknik)
        if (str_contains($major, 'pertanian') || str_contains($major, 'agroteknologi')) {
            return 'S.P.';
        }

        // 5. Cek Komputer/Informatika (Ditaruh sebelum Teknik)
        // Agar "Teknik Informatika" terbaca S.Kom, bukan S.T.
        if (str_contains($major, 'komputer') || str_contains($major, 'informatika') || str_contains($major, 'sistem informasi') || str_contains($faculty, 'mipa')) {
            return 'S.Kom.';
        }

        // 6. Cek Teknik (Generic untuk Sipil, Mesin, Elektro, Arsitektur)
        if (str_contains($major, 'teknik') || str_contains($faculty, 'teknik')) {
            return 'S.T.';
        }

        // 7. Kedokteran
        if (str_contains($major, 'dokter') || str_contains($major, 'kedokteran')) {
            return 'S.Ked.';
        }

        // 8. Komunikasi
        if (str_contains($major, 'komunikasi') || str_contains($major, 'sosial')) {
            return 'S.I.Kom.';
        }

        // 9. Seni & Desain
        if (str_contains($major, 'seni') || str_contains($major, 'desain') || str_contains($major, 'dkv')) {
            return 'S.Sn.';
        }
        
        return 'S.Tr.'; // Default
    }

    /**
     * Helper 2: Mendapatkan Nama Kepanjangan Gelar
     * Dipanggil dengan: $user->nama_gelar
     */
    public function getNamaGelarAttribute()
    {
        return match($this->gelar) {
            'S.Pd.' => 'SARJANA PENDIDIKAN',
            'S.Kom.' => 'SARJANA KOMPUTER',
            'S.H.' => 'SARJANA HUKUM',
            'S.E.' => 'SARJANA EKONOMI',
            'S.T.' => 'SARJANA TEKNIK',
            'S.Ked.' => 'SARJANA KEDOKTERAN',
            'S.P.' => 'SARJANA PERTANIAN',
            'S.I.Kom.' => 'SARJANA ILMU KOMUNIKASI',
            'S.Sn.' => 'SARJANA SENI',
            default => 'SARJANA TERAPAN',
        };
    }

    /**
     * Helper 3: Memperbaiki Nama Fakultas (FISP -> FISIP, dll)
     * Dipanggil dengan: $user->nama_fakultas
     */
    public function getNamaFakultasAttribute()
    {
        // Ambil data dari database, ubah ke uppercase agar match case-insensitive
        $rawFaculty = strtoupper($this->faculty ?? '');

        return match($rawFaculty) {
            'FISP' => 'Fakultas Ilmu Sosial dan Politik',   // Perbaikan Typo
            'FISIP' => 'Fakultas Ilmu Sosial dan Politik',
            'FKIP' => 'Fakultas Keguruan dan Ilmu Pendidikan',
            'FEB' => 'Fakultas Ekonomi dan Bisnis',
            'FT' => 'Fakultas Teknik',
            'FH' => 'Fakultas Hukum',
            'FMIPA' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
            'FP' => 'Fakultas Pertanian',
            'FK' => 'Fakultas Kedokteran',
            'FSRD' => 'Fakultas Seni Rupa dan Desain',
            'FOK' => 'Fakultas Olahraga dan Kesehatan',
            'FATISDA' => 'Fakultas Teknologi Informasi dan Sains Data',
            'SV' => 'Sekolah Vokasi',
            'PASCASARJANA' => 'Sekolah Pascasarjana',
            default => $this->faculty ?? '-' // Kembalikan aslinya jika tidak ada di daftar
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke tabel pendaftaran wisuda
     * Dipanggil dengan: Auth::user()->registration
     */
    public function registration()
    {
        return $this->hasOne(GraduationRegistration::class);
    }
}