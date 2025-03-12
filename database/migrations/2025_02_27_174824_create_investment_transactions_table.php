<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('investment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('product_packages')->onDelete('cascade');

            $table->decimal('amount', 15, 2); // Valor investido
            $table->decimal('profit_percent', 5, 2); // % de rendimento
            $table->tinyInteger('binary_position')->default(1); // 1 - Investidor 2 - Direita 3 - Esquerda

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('investment_transactions');
    }
};
