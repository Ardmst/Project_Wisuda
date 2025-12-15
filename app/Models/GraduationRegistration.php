<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationRegistration extends Model
{
    use HasFactory;

    protected $table = 'graduation_registrations';

    protected $fillable = [
        'user_id',
        'graduation_period_id', // <--- Pastikan ini ada
        'thesis_title',
        'parent_name',
        'toga_size',
        'ipk',
        'ips',
        'status',
    ];

    /**
     * Relasi 1: Pendaftaran milik satu User (Mahasiswa)
     * PENTING: Jangan dihapus, nanti Admin error pas buka daftar peserta.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi 2: Pendaftaran masuk ke satu Periode Wisuda
     * (Fitur Baru)
     */
    public function period()
    {
        return $this->belongsTo(GraduationPeriod::class, 'graduation_period_id');
    }
}