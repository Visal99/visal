<?php

use Illuminate\Database\Seeder;

class DocumentCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	       DB::table('document_categories')->insert(
            [
                [
                    'slug'              => 'road-transport', 
                    'en_title'              => 'Road Transport', 
                    'kh_title'              => 'Road Transport', 
                ],
                [
                    'slug'              => 'road-safety', 
                    'en_title'              => 'Road Safety', 
                    'kh_title'              => 'Road Safety', 
                ],
                [
                    'slug'              => 'logistics', 
                    'en_title'              => 'Logistics', 
                    'kh_title'              => 'Logistics', 
                ],
                [
                    'slug'              => 'railways', 
                    'en_title'              => 'Railways', 
                    'kh_title'              => 'Railways', 
                ],
                [
                    'slug'              => 'public-works', 
                    'en_title'              => 'Public Works', 
                    'kh_title'              => 'Public Works', 
                ],
                [
                    'slug'              => 'water-way', 
                    'en_title'              => 'Port, Water way, and Marine Transport', 
                    'kh_title'              => 'Port, Water way, and Marine Transport', 
                ],
                [
                    'slug'              => 'planning-and-policies', 
                    'en_title'              => 'Planning and Policies', 
                    'kh_title'              => 'Planning and Policies', 
                ],
                [
                    'slug'              => 'Other', 
                    'en_title'              => 'Other', 
                    'kh_title'              => 'Other', 
                ],
            ]
        );
	}
}
