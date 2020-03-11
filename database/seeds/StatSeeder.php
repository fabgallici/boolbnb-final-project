<?php

use Illuminate\Database\Seeder;
use App\Stat;
use App\Apartment;
use Carbon\Carbon;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Stat::class, 10) 
        //         -> make()
        //         -> each(function($stat) {
        //             $apartment = Apartment::inRandomOrder() -> first();
        //             $stat -> apartment() -> associate($apartment);
        //             $stat -> save(); 
        // });

        // $faker = Factory::create();
        $apartment = Apartment::all()->last();
        $counter = 1;
        for ($i=1; $i<8 ; $i++) {      
            $date = Carbon::now()->modify('-'.$counter.' day');
            $createdDate = clone($date);
            $rndCounter = rand(2,14);

            for ($a=1; $a<$rndCounter ; $a++) { 
                $stat = Stat::make([
                'created_at' => $createdDate,
                'updated_at' => $createdDate
                ]);
                $stat -> apartment() -> associate($apartment);
                $stat -> save();

            }
            
            $counter++;
        }


    }
}
