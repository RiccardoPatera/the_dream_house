<?php

use App\Models\Occurence;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('occurences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });


    $occurences = ['Natale','Pasqua','Nascita','Battesimo','Comunione','Cresima','Matrimonio','Laurea','Anniversari'];

        foreach ($occurences as $occurence) {
                Occurence::create([
                'name' => $occurence
            ]);
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occurences');
    }
};
