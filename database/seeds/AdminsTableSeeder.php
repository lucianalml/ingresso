<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

    	$admins = [
    		0 => [  'id' => 4 ],

    		1 => [	'id' => 5 ]
    	];
		  
		DB::table('admins')->insert($admins);

    }
}
