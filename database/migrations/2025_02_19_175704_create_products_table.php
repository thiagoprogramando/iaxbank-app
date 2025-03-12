<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('photo')->nullable();
            $table->string('name');
            $table->string('acronym')->nullable();
            $table->text('description')->nullable();

            $table->decimal('value', 15, 2)->default(0);
            $table->decimal('performance', 5, 2)->default(0);
            $table->enum('time', ['day', 'month', 'year']);

            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
