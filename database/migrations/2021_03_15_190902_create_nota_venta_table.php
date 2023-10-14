<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->float('montoTotal');

            $table->integer('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_venta');
    }
}
