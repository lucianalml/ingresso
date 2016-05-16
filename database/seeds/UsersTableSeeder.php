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
        DB::table('users')->delete();

    	$users = [
    		0 => [  'email' => 'albert@hoffman.com',
		            'password' => Hash::make('password'),
		            'name' => 'Albert hoffman'],

    		1 => [	'email' => 'admin@ingresso.art.br',
		            'password' => Hash::make('adminpassword'),
		            'name' => 'Administrador']
    	];
		  
		DB::table('users')->insert($users);

    }
}
