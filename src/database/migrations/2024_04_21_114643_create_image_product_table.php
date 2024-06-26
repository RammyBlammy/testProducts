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
        Schema::create('image_product', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product');
            $table->string('img_link')->comment('ссылка на фото');
            $table->string('path')->nullable()->comment('Путь к фото');
            $table->primary(['product_id', 'img_link']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_product');
    }
};
