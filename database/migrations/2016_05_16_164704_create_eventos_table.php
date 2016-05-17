<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('eventos');


        Schema::create('eventos', function (Blueprint $table) {

            $table->engine = 'MyISAM';

            $table->increments('id');
            $table->string('nome');
            $table->text('descricao');
            $table->date('data');
            $table->time('hora');
            $table->string('local');
            $table->integer('produtor_id')->unsigned();
            $table->timestamps();

            $table->foreign('produtor_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
