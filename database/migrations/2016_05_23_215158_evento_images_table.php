<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventoImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_imagens', function (Blueprint $table) {

        $table->engine = 'MyISAM';

// Campos da tabela
        $table->integer('evento_id')->unsigned();
        $table->integer('id')->unsigned();
        $table->string('path');
        $table->string('thumbnail_path');

// Chave primária
        $table->primary(['evento_id', 'id']);

// Chave estrangeira
        $table->foreign('evento_id')
            ->references('id')
            ->on('eventos')
            ->onDelete('cascade');

        });

        Schema::table('evento_imagens', function($table)
        {
            DB::statement('ALTER TABLE evento_imagens MODIFY id INTEGER NOT NULL AUTO_INCREMENT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('evento_imagens');
    }
}
