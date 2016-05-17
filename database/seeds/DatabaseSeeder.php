<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UsersTableSeeder::class);
//		$this->command->info('Users table seeded!');

//        $this->call(AdminsTableSeeder::class);
//        $this->command->info('Admins table seeded!');

        $this->call(EventosTableSeeder::class);
        $this->command->info('Eventos table seeded!');

    }
}
