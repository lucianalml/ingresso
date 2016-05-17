<?php

use Illuminate\Database\Seeder;

class LotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$lotes = [
    		0 => [  'evento_id' => '4',
		            'descricao' => 'Feminino Pista',
		            'preco' => '45.00' ],

    		1 => [  'evento_id' => '4',
		            'descricao' => 'Masculino Pista',
		            'preco' => '85.00' ],
    	];
		  
		DB::table('lotes')->insert($lotes);
    }
}
