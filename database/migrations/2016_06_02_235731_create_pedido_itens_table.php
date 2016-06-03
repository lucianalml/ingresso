<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_itens', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('pedido_id')->unsigned();
            $table->integer('lote_id')->unsigned();
            $table->integer('quantidade');
            $table->decimal('valor', 10, 2)->unsigned();

            // Chave estrangeiras
            $table->foreign('pedido_id')
                ->references('id')->on('pedidos');

            $table->foreign('lote_id')
                ->references('id')->on('lotes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedido_itens');
    }
}
