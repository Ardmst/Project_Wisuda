<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('graduation_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->date('graduation_date'); 
            $table->integer('quota'); 
            $table->enum('status', ['open', 'closed'])->default('open'); 
            $table->text('description')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('graduation_periods');
    }
};