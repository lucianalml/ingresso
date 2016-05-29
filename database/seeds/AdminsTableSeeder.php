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

        $users = [
            0 => [  'email' => 'admin@ingresso.art.br',
                    'password' => Hash::make('123123'),
                    'name' => 'Administrador'],

            1 => [  'email' => 'luciana@ingresso.art.br',
                    'password' => Hash::make('123123'),
                    'name' => 'Luciana'],

            2 => [  'email' => 'pedro@ingresso.art.br',
                    'password' => Hash::make('123123'),
                    'name' => 'Pedro'],

            3 => [  'email' => 'claudio@ingresso.art.br',
                    'password' => Hash::make('123123'),
                    'name' => 'Claudio'],

        ];
          
        DB::table('admins')->insert($users);

    }
}
