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
        // Kita taruh kolom ini setelah kolom IPK biar rapi
        $table->string('thesis_title')->nullable()->after('ipk');
    });
}

public function down(): void
{
    Schema::table('graduation_registrations', function (Blueprint $table) {
        $table->dropColumn('thesis_title');
    });
}
};
