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
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Nama Lengkap
                $table->string('nim')->unique(); // NIM sebagai username login
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                
                // Info Akademik Mahasiswa
                $table->string('faculty'); // Fakultas
                $table->string('major'); // Program Studi
                $table->year('cohort'); // Angkatan
                $table->integer('semester')->default(1);

                // Role untuk membedakan mahasiswa dan admin
                $table->enum('role', ['mahasiswa', 'admin'])->default('mahasiswa');
                
                $table->rememberToken();
                $table->timestamps();
            });

            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });

            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('users');
            Schema::dropIfExists('password_reset_tokens');
            Schema::dropIfExists('sessions');
        }
    };
    

