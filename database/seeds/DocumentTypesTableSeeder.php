<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	       DB::table('document_types')->insert(
            [
                [
                    'slug'              => 'prakas', 
                    'en_title'              => 'Prakas', 
                    'kh_title'              => 'Prakas',
                ],
                [
                    'slug'              => 'law', 
                    'en_title'              => 'Law', 
                    'kh_title'              => 'Law',
                ],
                [
                    'slug'              => 'policy', 
                    'en_title'              => 'Policy', 
                    'kh_title'              => 'Policy',
                ],
                [
                    'slug'              => 'agreement-mou', 
                    'en_title'              => 'Agreement & MOU', 
                    'kh_title'              => 'Agreement & MOU',
                ],
                [
                    'slug'              => 'sub-decree', 
                    'en_title'              => 'Sub-decree', 
                    'kh_title'              => 'Sub-decree',
                ],
                [
                    'slug'              => 'decree', 
                    'en_title'              => 'Decree', 
                    'kh_title'              => 'Decree',
                ],
            ]
        );
	}
}
