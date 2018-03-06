<?php

use Illuminate\Database\Seeder;
use App\Platform;

class PlatformSeeder extends Seeder
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
		    Platform::create( [
			    'name' => $faker->name,
		    ] );
	    }
    }
}
