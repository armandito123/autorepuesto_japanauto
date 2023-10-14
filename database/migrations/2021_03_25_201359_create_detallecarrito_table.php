<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallecarritoTable extends Migration
{
    public function up()
    {
        Schema::create('detallecarrito', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->string('medida');
            $table->string('submedida');
            $table->integer('refPedido')->unsigned()->nullable();

            $table->integer('estado')->unsigned()->default(0);

            $table->integer('idCarrito')->unsigned();
            $table->foreign('idCarrito')->references('id')->on('carrito')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('idRepuesto')->unsigned();
            $table->foreign('idRepuesto')->references('id')->on('repuestos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('detallecarrito');
    }
}
