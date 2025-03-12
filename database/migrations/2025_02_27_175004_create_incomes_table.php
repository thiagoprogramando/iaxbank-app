<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('product_packages')->onDelete('cascade');

            $table->decimal('amount', 15, 2); // Valor total gerado
            $table->decimal('profit_percent', 5, 2); // % de rendimento aplicada
            $table->json('user_distribution')->nullable(); // Usuários que tiveram carteira alteradas

            $table->decimal('binary_left_percent', 5, 2)->default(0); // Esquerdo %
            $table->decimal('binary_right_percent', 5, 2)->default(0); // Direito %
            $table->json('binary_distribution')->nullable(); // Usuários que tiveram carteira alteradas

            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->timestamp('executed_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('incomes');
    }
};
