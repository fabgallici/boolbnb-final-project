<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder {

	public function run()
	{
		$this->call([
			UserSeeder::class,
			ApartmentSeeder::class,
			ConfigSeeder::class,
			MessageSeeder::class,
			AdSeeder::class,
			StatSeeder::class
		]);

	}
}
