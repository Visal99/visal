<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('images')->insert(
            [
                [
                    'page'              => 'sample-page',
                    'slug'              => 'single-image-for-sample-page',  
                    'name'              => 'Banner 1', 
                    'note'              => '',
                    'published'         => 1,
                    'image'             => '',
                    'width'             => 0,
                    'height'            => 0,
                    'updater_id'        => 1,
                ],
                [
                    'page'              => 'sample-page',
                    'slug'              => 'single-image-for-sample-page 1',  
                    'name'              => 'Banner 1', 
                    'note'              => '',
                    'published'         => 1,
                    'image'             => '',
                    'width'             => 0,
                    'height'            => 0,
                    'updater_id'        => 1,
                ],
                 [
                    'page'              => 'sample-page',
                    'slug'              => 'single-image-for-sample-page 2',  
                    'name'              => 'Banner 2', 
                    'note'              => '',
                    'published'         => 1,
                    'image'             => '',
                    'width'             => 0,
                    'height'            => 0,
                    'updater_id'        => 1,
                ],
               
            ]
        );
	}
}
