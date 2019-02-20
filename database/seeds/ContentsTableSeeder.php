<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	   DB::table('contents')->insert(
            [
                [
                    'page'              => 'sample-page',
                    'slug'              => 'single-content-for-sample-page', 
                    'name'              => 'Single Content for Sample Page', 
                    'en_content'        => 'en content', 
                    'kh_content'        => 'kh content',
                    'note'              => '',
                    'image_required'    => 0,
                    'image'             => '',
                    'width'             => 0,
                    'height'            => 0,
                    'editor_required'   => 0,
                    'updater_id'        => 1,
                ],
               [
                    'page'              => 'sample-page',
                    'slug'              => 'single-content-for-sample-page 1', 
                    'name'              => 'Single Content for Sample Page 1', 
                    'en_content'        => 'en content', 
                    'kh_content'        => 'kh content',
                    'note'              => '',
                    'image_required'    => 0,
                    'image'             => '',
                    'width'             => 0,
                    'height'            => 0,
                    'editor_required'   => 0,
                    'updater_id'        => 1,
                ],
                [
                    'page'              => 'sample-page',
                    'slug'              => 'single-content-for-sample-page 2', 
                    'name'              => 'Single Content for Sample Page 2', 
                    'en_content'        => 'en content', 
                    'kh_content'        => 'kh content',
                    'note'              => '',
                    'image_required'    => 0,
                    'image'             => '',
                    'width'             => 0,
                    'height'            => 0,
                    'editor_required'   => 0,
                    'updater_id'        => 1,
                ],
               
            ]
        );
	}
}
