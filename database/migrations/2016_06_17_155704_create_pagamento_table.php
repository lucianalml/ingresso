<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pagamentos');
        
        Schema::create('pagamentos', function (Blueprint $table) {

            $table->engine = 'MyISAM';

            $table->increments('id');

            $table->char('tipo', 20);
            $table->integer('pedido_id')->unsigned();
            
            $table->string('transacao');

            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('pedido_id')
                ->references('id')->on('pedidos');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
