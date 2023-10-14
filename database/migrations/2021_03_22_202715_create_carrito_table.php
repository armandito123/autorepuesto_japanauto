<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{

    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->increments('id');
            $table->float('monto');
            $table->boolean('estado')->default(0);

            $table->integer('idCliente')->unsigned();
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrito');
    }
}
