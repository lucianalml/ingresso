<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lotes', function ($table) {
            $table->decimal('taxa_adm', 10, 2)->unsigned();
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
        Schema::table('lotes', function ($table) {
            $table->dropColumn('taxa_adm');
            $table->dropColumn('valor_total');
        });
    }
}
