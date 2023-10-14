<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepuestoAlmacen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repuesto_almacen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock')->unsigned();

            $table->integer('idRepuesto')->unsigned();
            $table->integer('idAlmacen')->unsigned()->nullable();

            $table->foreign('idRepuesto')->references('id')->on('repuestos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idAlmacen')->references('id')->on('almacenes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repuesto_almacen');
    }
}
