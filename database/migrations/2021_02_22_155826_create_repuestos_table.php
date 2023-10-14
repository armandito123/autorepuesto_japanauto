<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepuestosTable extends Migration
{

    public function up()
    {
        Schema::create('repuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion')->default('');
            $table->string('codigo')->default('');
            $table->float('precioVenta');
            $table->float('precioCompra')->nullable();
            $table->string('imagen');

            $table->integer('idCategoria')->unsigned();
            $table->integer('idMarcaModelo')->unsigned();
            $table->integer('idTipoRepuesto')->unsigned();

            $table->foreign('idCategoria')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idMarcaModelo')->references('id')->on('marca_modelos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idTipoRepuesto')->references('id')->on('tipo_repuestos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repuestos');
    }
}
