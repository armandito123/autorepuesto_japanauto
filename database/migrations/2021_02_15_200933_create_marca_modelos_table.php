<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcaModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marca_modelos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('medida');
            $table->string('submedida');

            $table->integer('idMarca')->unsigned();
            $table->integer('idModelo')->unsigned();

            $table->foreign('idMarca')->references('id')->on('marcas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idModelo')->references('id')->on('modelos')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marca_modelos');
    }
}
