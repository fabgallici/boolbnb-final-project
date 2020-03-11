<?php

use Illuminate\Database\Seeder;
use App\Config;
use App\Apartment;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $configs = [
            'wifi',
            'parking',
            'pool',
            'reception',
            'sauna',
            'sight'
        ];

        foreach($configs as $config) { //Listo i miei servizi da inserire...
            $config = Config::create([
                'service' => $config
            ]);

            //Associo ad N post il tag appena inserito
            $apartment = Apartment::inRandomOrder() -> take(rand(1, 10)) -> get();
            $config -> apartments() -> attach($apartment);
        }

    }
}
