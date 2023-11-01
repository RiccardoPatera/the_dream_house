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
            $table->string('title');
            $table->string('description');
            $table->decimal('price', 6, 2);
            $table->string('barcode', 13);
            // $table->unsignedBigInteger('color_id');
            // $table->foreign('color_id')->references('id')->on('colors');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products', function (Blueprint $table){
        });
    }
};

// $table->dropForeign(['user_id']);
//             $table->dropColumn('user_id');
//             $table->dropForeign(['shop_sessions']);
//             $table->dropColumn('shop_sessions');
