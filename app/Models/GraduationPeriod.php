<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'graduation_date',
        'quota',
        'status',
        'description',
    ];

    // Relasi: Satu periode punya banyak pendaftar
    public function registrations()
    {
        return $this->hasMany(GraduationRegistration::class);
    }

    // Hitung sisa kuota
    public function getRemainingQuotaAttribute()
    {
        // Hitung jumlah pendaftar yang statusnya BUKAN ditolak
        $registeredCount = $this->registrations()
            ->where('status', '!=', 'rejected')
            ->count();
            
        return $this->quota - $registeredCount;
    }
}