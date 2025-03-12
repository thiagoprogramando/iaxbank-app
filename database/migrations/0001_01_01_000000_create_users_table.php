<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('sponsor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('binary_left_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('binary_right_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('position')->default(1); // Esquerda (1) ou Direita (2)

            $table->text('photo')->nullable();
            $table->string('name');
            $table->string('cpfcnpj')->nullable();

            $table->decimal('wallet', 15, 2)->default(0);
            $table->decimal('wallet_investment', 15, 2)->default(0);
            $table->decimal('wallet_accumulated', 15, 2)->default(0);

            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('type')->default(2); // Administrador (1) ou Cliente (2)
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
