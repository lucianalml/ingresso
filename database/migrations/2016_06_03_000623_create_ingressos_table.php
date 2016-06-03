<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngressosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingressos', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('pedido_item_id')->unsigned();
            $table->string('nome');
            $table->string('documento');

            $table->timestamps();

            // Chave estrangeiras
            $table->foreign('pedido_item_id')
                ->references('id')->on('pedido_itens');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ingressos');
    }
}
