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
        Schema::dropIfExists('ingressos');
        
        Schema::create('ingressos', function (Blueprint $table) {

            $table->engine = 'MyISAM';

            $table->increments('id');

            $table->integer('pedido_item_id')->unsigned();
            $table->string('nome');
            $table->string('documento');

            $table->string('qr_code', 100)->unique();

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
        Schema::dropIfExists('ingressos');
    }
}
