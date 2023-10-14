<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad')->unsigned();
            $table->float('subTotal');

            $table->integer('idRepuestoAlmacen')->unsigned();
            $table->foreign('idRepuestoAlmacen')->references('id')->on('repuesto_almacen')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('idNotaVenta')->unsigned();
            $table->foreign('idNotaVenta')->references('id')->on('nota_venta')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_venta');
    }
}
