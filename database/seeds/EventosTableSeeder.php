<?php

use Illuminate\Database\Seeder;

class EventosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('eventos')->delete();

    	$eventos = [
    		0 => [  'nome' => 'Psicodalia',
		            'descricao' => 'Psicodalia 2017',
		            'data' => '2017-02-11',
		            'hora' => '14:30:00',
		            'local'=> 'Fazenda Evaristo',
		            'produtor_id' => '5' ],

    		1 => [  'nome' => 'Tribaltech',
		            'descricao' => 'Tribaltech 2017',
		            'data' => '2016-06-20',
		            'hora' => '18:45:00',
		            'local'=> 'Fazenda Evaristo',
		            'produtor_id' => '6' ],

    	];
		  
		DB::table('eventos')->insert($eventos);
    }
}
