<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePedidoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::table('pedido_itens', function ($table) {
            $table->dropColumn('valor');
        });

        Schema::table('pedido_itens', function ($table) {
            $table->decimal('valor_unitario', 10, 2)->unsigned();
            $table->decimal('valor_total', 10, 2)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido_itens', function ($table) {
            $table->dropColumn('valor_unitario');
            $table->dropColumn('valor_total');
        });

        Schema::table('pedido_itens', function ($table) {
            $table->decimal('valor', 10, 2)->unsigned();
        });
    }
}
