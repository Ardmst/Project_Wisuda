<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationRegistration extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'graduation_registrations';

    /**
     * Kolom yang diizinkan untuk diisi secara massal (Mass Assignment).
     * Semua kolom yang diisi di Controller harus ada di sini.
     */
    protected $fillable = [
        'user_id', // <--- INI PERBAIKANNYA
        'parent_name',
        'toga_size',
        'ipk',
        'ips',
        'status',
    ];

    /**
     * Relasi ke Model User.
     * Satu pendaftaran wisuda dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
