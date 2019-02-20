<?php

use Illuminate\Database\Seeder;

class PressCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	       DB::table('press_categories')->insert(
            [
                [
                    'slug'              => 'announcement', 
                    'name'              => 'Announcement', 
                ],
                [
                    'slug'              => 'public-works', 
                    'name'              => 'Public works', 
                ],
                [
                    'slug'              => 'road-transport', 
                    'name'              => 'Road Transport', 
                ],
                [
                    'slug'              => 'water-way-transport', 
                    'name'              => 'Water way transport', 
                ],
                [
                    'slug'              => 'marine-transport', 
                    'name'              => 'Marine Transport', 
                ],
                [
                    'slug'              => 'railways-transport', 
                    'name'              => 'Railways Transport', 
                ],
                [
                    'slug'              => 'road-safety', 
                    'name'              => 'Road Safety', 
                ],
                [
                    'slug'              => 'picture-collections', 
                    'name'              => 'Picture collections', 
                ],
            ]
        );
	}
}
