<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Category;
use App\Models\Occurence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        $brands = ['Blanc Mariclò','Mathilde M.','Wald','Cupido & Co.', 'Souvenir Planet', 'EuroCinsa', 'Le Stelle', 'Stewo' , 'Giovinazzo', 'Lamart', 'Palais Royal' ,'EDG',
        'Coccole di casa', 'Orval' , 'Lenox', 'Kaleidos', 'Simla', 'Rosso Regale','Gattinoni', 'Light and Living' , 'SiroTime', 'Lene Bjerre', "Price's Candles",'Horo Mia', 'Tono su Tono' , 'Dekoratief', 'Egan', 'Chipolo' , 'Kit-Cat', 'Caruso & Co.' ,'B&P Italia','Nachtmann', 'Claire & Eef' ];

        foreach ($brands as $brand) {
                Brand::create([
                'name' => $brand
            ]);

        }

        $categories = ['Outlet','Profumatori','Candele','Bomboniere','Tessile','Oggettistica','Accessori','Materiale per confezionare','Prima Infanzia','Decorazioni'];

        foreach ($categories as $category) {
                Category::create([
                'name' => $category
            ]);
        }

        $occurences = ['Natale','Pasqua','Nascita','Battesimo','Comunione','Cresima','Matrimonio','Laurea','Anniversari'];

        foreach ($occurences as $occurence) {
                Occurence::create([
                'name' => $occurence
            ]);

        }
            $colorstyle = ['red','green','blue','yellow','white','black','grey'];
            $colors = ['rosso','verde','blu','giallo','bianco','nero','grigio'];

            for($i=0; $i<count($colors); $i++){
                Color::create([
                    'name'=>$colors[$i],
                    'style'=>$colorstyle[$i],
                ]);
        }
    }
}
