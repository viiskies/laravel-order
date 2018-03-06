<?php

use Illuminate\Database\Seeder;
use App\Publisher;

class PublishersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $faker = Faker\Factory::create();
	    for($i=0;$i<10;$i++) {
		    Publisher::create( [
			    'name' => $faker->name,
		    ] );
	    }
    }
}
