<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('product_incomes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('product_packages')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->decimal('profit_percent', 5, 2);
            $table->tinyInteger('status')->default(2);
            $table->timestamps();
            $table->timestamp('executed_at')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_incomes');
    }
};
