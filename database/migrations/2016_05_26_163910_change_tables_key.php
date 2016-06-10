<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTablesKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('lotes');

        Schema::create('lotes', function (Blueprint $table) { 
            
            $table->engine = 'MyISAM';

            $table->increments('id');

            $table->integer('evento_id')->unsigned();

            $table->string('descricao');
            $table->decimal('preco', 10, 2)->unsigned();
            $table->timestamps();

            $table->foreign('evento_id')
                ->references('id')->on('eventos')
                ->onDelete('cascade');
        });


        Schema::dropIfExists('evento_imagens');

        Schema::create('evento_imagens', function (Blueprint $table) {

        $table->engine = 'MyISAM';

        // Chave primária
        $table->increments('id');

        // Campos 
        $table->integer('evento_id')->unsigned();
        $table->string('path');
        $table->string('thumbnail_path');

        // Chave estrangeira
        $table->foreign('evento_id')
            ->references('id')
            ->on('eventos')
            ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lotes');
        Schema::dropIfExists('evento_imagens');
    }
}
