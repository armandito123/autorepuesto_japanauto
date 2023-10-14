<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad')->unsigned();
            $table->float('subTotal');

            $table->integer('idRepuestoAlmacen')->unsigned()->nullable();
            $table->foreign('idRepuestoAlmacen')->references('id')->on('repuesto_almacen')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('idPedido')->unsigned();
            $table->foreign('idPedido')->references('id')->on('pedido')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_pedido');
    }
}
