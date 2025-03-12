<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('product_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->decimal('value', 15, 2)->default(0);
            $table->decimal('performance', 5, 2)->default(0);
            $table->decimal('binary_left_percent', 5, 2)->default(0); // % Rede Esquerda
            $table->decimal('binary_right_percent', 5, 2)->default(0); // % Rede Direita
            $table->enum('time', ['day', 'month', 'semester', 'year']);
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_package');
    }
};
