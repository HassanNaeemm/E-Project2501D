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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ProductName');
            $table->string('ProductDescription');
            $table->string('ProductImage');
            $table->integer('ProductSKU');
            $table->integer('RegularPrice');
            $table->date('SaleStart');
            $table->date("SaleEnd");
            $table->integer('SalePercentage');
            $table->bigInteger('SalePrice');
            $table->integer('CategoryId');
            $table->foreign('CategoryId')->references('categories')->on('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
