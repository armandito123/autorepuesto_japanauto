<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionTable extends Migration
{
  
    public function up()
    {
        Schema::create('ubicacion', function (Blueprint $table) {
            $table->increments('id');
            $table->double('latitud');
            $table->double('longitud');
            $table->text('referencia');
            $table->text('url');
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('ubicacion');
    }
}
