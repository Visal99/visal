<?php

use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	       DB::table('blogs')->insert(
            [
                [
                    'slug'              => 'blog-1', 
                    'kh_title'          => 'blog 1', 
                    'en_title'          => 'blog 2',
                    'kh_content'          => 'blog 1', 
                    'en_content'          => 'blog 2', 
                ],
                
               
            ]
        );
	}
}
