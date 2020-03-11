<?php

use Illuminate\Database\Seeder;
use App\Ad;
use App\Apartment;

class AdSeeder extends Seeder
{
    public function run()
    {
        $prices = [299,599,999];

        foreach($prices as $price) { //Listo i miei servizi da inserire...
            $price = Ad::create([
                'price' => $price
            ]);

            //Associo ad N annunci/appartamenti un prezzo tra questi tre
            $apartment = Apartment::inRandomOrder() -> take(rand(1, 10)) -> get();
            $price -> apartments() -> attach($apartment);
        }
    }
}
