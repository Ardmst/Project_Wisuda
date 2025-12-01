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
        Schema::create('graduation_registrations', function (Blueprint $table) {
            $table->id();
            // Kunci asing ke tabel users (WAJIB ADA)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); 
            $table->string('parent_name');
            $table->string('toga_size');
            $table->decimal('ipk', 3, 2); // 3 digit total, 2 di belakang koma (misal 3.85)
            $table->decimal('ips', 3, 2); 
            $table->string('status')->default('pending'); // Status: pending, verified, rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduation_registrations');
    }
};
