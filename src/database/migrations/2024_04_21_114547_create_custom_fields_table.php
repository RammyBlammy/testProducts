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
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product');
            $table->string('size')->nullable()->comment('размер');
            $table->string('color')->nullable()->comment('цвет');
            $table->string('brand')->nullable()->comment('бренд');
            $table->mediumText('composition')->nullable()->comment('состав');
            $table->integer('count_by_package')->default(0)->comment('кол-во в упаковке');
            $table->longText('link_package')->nullable()->comment('ссылка на упаковку');
            $table->longText('links_image')->nullable()->comment('ссылки на фото');
            $table->longText('seo_title')->nullable()->comment('сео тайтл');
            $table->longText('seo_h1')->nullable()->comment('сео заголовок');
            $table->longText('seo_description')->nullable()->comment('сео описание');
            $table->integer('weight')->default(0)->comment('вес товара');
            $table->integer('width')->default(0)->comment('ширина');
            $table->integer('height')->default(0)->comment('высота');
            $table->integer('length')->default(0)->comment('длина');
            $table->integer('weight_package')->default(0)->comment('вес упаковки');
            $table->integer('width_package')->default(0)->comment('ширина упаковки');
            $table->integer('height_package')->default(0)->comment('высота упаковки');
            $table->integer('length_package')->default(0)->comment('длина упаковки');
            $table->string('category')->nullable()->comment('категория товара');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_fields');
    }
};
