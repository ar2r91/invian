<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Usuariocategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuariocategoria', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('id_categoria')->unsigned();
            $table->integer('id_usuario')->unsigned();
        });

        Schema::table('usuariocategoria', function ($table) {
            $table->foreign('id_categoria')->references('id')->on('categoria');
            $table->foreign('id_usuario')->references('id')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuariocategoria');
    }
}
