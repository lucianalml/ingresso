<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) { 

            $table->engine = 'MyISAM';

            $table->integer('evento_id')->unsigned();
            $table->integer('id')->unsigned();

            $table->string('descricao');
            $table->decimal('preco', 10, 2)->unsigned();
            $table->timestamps();

            $table->primary(['evento_id', 'id']);

// TODO - Não está gerando a foreign key =/
            $table->foreign('evento_id')
                ->references('id')
                ->on('eventos')
                ->onDelete('cascade');
                
        });


        Schema::table('lotes', function($table)
        {

            DB::statement('ALTER TABLE lotes MODIFY id INTEGER NOT NULL AUTO_INCREMENT');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lotes');
    }
}
