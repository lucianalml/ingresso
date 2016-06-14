<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEventosTab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos', function ($table) {
            $table->string('genero');
            $table->string('estado', 2);
            $table->string('cidade', 50);
            $table->boolean('ativo');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventos', function ($table) {
            $table->dropColumn('estado');
            $table->dropColumn('cidade');
            $table->dropColumn('ativo');
            $table->dropColumn('genero');
        });

    }
}
