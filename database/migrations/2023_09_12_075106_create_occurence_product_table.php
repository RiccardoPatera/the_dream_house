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
        Schema::create('occurence_product', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('occurence_id');
        $table->foreign('occurence_id')->references('id')->on('occurences');
        $table->unsignedBigInteger('product_id');
        $table->foreign('product_id')->references('id')->on('products');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occurence_product');
    }
};
