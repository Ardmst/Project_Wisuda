<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('graduation_registrations', function (Blueprint $table) {
            $table->foreignId('graduation_period_id')
                  ->nullable() // Boleh kosong dulu
                  ->after('user_id') // Posisi setelah kolom user_id
                  ->constrained('graduation_periods') // Sambung ke tabel periods
                  ->nullOnDelete(); // Kalau periode dihapus, data mhs tetap aman (jadi null)
        });
    }

    public function down(): void
    {
        Schema::table('graduation_registrations', function (Blueprint $table) {
            $table->dropForeign(['graduation_period_id']);
            $table->dropColumn('graduation_period_id');
        });
    }
};