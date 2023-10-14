<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class VentaController extends Controller
{
    public function mostrar(){
        return view('pages.venta.mostrar');
    }

    public function crear(){
        return view('pages.venta.insertar');
    }
}
