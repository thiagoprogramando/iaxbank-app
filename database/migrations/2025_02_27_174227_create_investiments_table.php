<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('investiments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('product_package')->onDelete('cascade');

            $table->decimal('amount', 15, 2); // Valor investido
            $table->decimal('profit_percent', 5, 2); // % de rendimento

            $table->string('payment_token')->nullable(); // Token de pagamento
            $table->string('payment_payload')->nullable(); // Payload

            $table->tinyInteger('status')->default(2); // Ativo/Pendente
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('investiments');
    }
};
