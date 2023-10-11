<?php

use App\Models\Brand;
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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $brands = ['Blanc Mariclò','Mathilde M.','Wald','Cupido & Co.', 'Souvenir Planet', 'EuroCinsa', 'Le Stelle', 'Stewo' , 'Giovinazzo', 'Lamart', 'Palais Royal' ,'EDG',
        'Coccole di casa', 'Orval' , 'Lenox', 'Kaleidos', 'Simla', 'Rosso Regale','Gattinoni', 'Light and Living' , 'SiroTime', 'Lene Bjerre', "Price's Candles",'Horo Mia', 'Tono su Tono' , 'Dekoratief', 'Egan', 'Chipolo' , 'Kit-Cat', 'Caruso & Co.' ,'B&P Italia' ];

        foreach ($brands as $brand) {
                Brand::create([
                'name' => $brand
            ]);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
