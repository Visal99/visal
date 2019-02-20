<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	       DB::table('contacts')->insert(
            [
                [
                    'slug'              => 'ministry-headquarters', 
                    'en_title'              => 'Ministry headquarters', 
                    'kh_title'              => 'Ministry headquarters',
                ],
                [
                    'slug'              => 'general-departments', 
                    'en_title'              => 'General Departments', 
                    'kh_title'              => 'General Departments',
                ],
                [
                    'slug'              => 'provincial-department', 
                    'en_title'              => 'Provincial Department', 
                    'kh_title'              => 'Provincial Department',
                ],
                [
                    'slug'              => 'support-line-for-automation-systems', 
                    'en_title'              => 'Support Line for Automation Systems', 
                    'kh_title'              => 'Support Line for Automation Systems',
                ],
               
            ]
        );
	}
}
