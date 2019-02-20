<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
	     DB::table('users')->insert(
                [
                ['name' => "System",'email' => 'system@camcyber.com', 'phone' => '012345675', 'position_id' => 1, 'active'=>1, 'visible'=>0, 'password' => bcrypt('xxxxxx')],
                ['name' => "Admin",'email' => 'admin@camcyber.com', 'phone' => '012345678', 'position_id' => 1, 'active'=>1, 'visible'=>1, 'password' => bcrypt('123456')],
                ['name' => "User",'email' => 'user@camcyber.com', 'phone' => '0123456784', 'position_id' => 2,  'active'=>1, 'visible'=>1, 'password' => bcrypt('123456')],
            ]);
	}
}
