<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom fakultas setelah kolom 'email'
            $table->string('fakultas')->after('email')->nullable();
            // Tambahkan kolom tahun_masuk setelah kolom 'fakultas'
            $table->year('tahun_masuk')->after('fakultas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Perintah untuk menghapus kolom jika migration di-rollback
            $table->dropColumn(['fakultas', 'tahun_masuk']);
        });
    }
};
