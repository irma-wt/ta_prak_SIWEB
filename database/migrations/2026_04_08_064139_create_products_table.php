<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id')->primarykey();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('product_stock');
            $table->timestamps();

            // Relasi ke tabel categories
            $table->foreign('category_id')
                  ->references('category_id')
                  ->on('categories')
                  ->onDelete('cascade');

            // Relasi ke tabel brands
            $table->foreign('brand_id')
                  ->references('brand_id')
                  ->on('brands')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};