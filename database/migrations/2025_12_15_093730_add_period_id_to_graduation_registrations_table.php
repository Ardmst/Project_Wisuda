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
        Schema::table('graduation_registrations', function (Blueprint $table) {
            // Cek dulu biar gak error "Column already exists"
            if (!Schema::hasColumn('graduation_registrations', 'graduation_period_id')) {
                $table->foreignId('graduation_period_id')
                      ->nullable()
                      ->after('user_id')
                      ->constrained('graduation_periods')
                      ->nullOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('graduation_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('graduation_registrations', 'graduation_period_id')) {
                // Hapus foreign key dulu (format: namatabel_namakolom_foreign)
                $table->dropForeign(['graduation_period_id']);
                $table->dropColumn('graduation_period_id');
            }
        });
    }
};