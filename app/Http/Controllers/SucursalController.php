<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function mostrar(Request $request){
        $sucursal=Sucursal::all();

        if($request){ /*Muestras los registros filtrador por atributos*/
            $query = trim($request->get('searchText'));
            $sucursal = Sucursal::select('id','nombre','ubicacion')
            ->where('nombre','LIKE','%'.$query.'%')
            ->paginate(5);
        }else{/*Muestras todos los registros y hace paginacion a la vez*/
            $sucursal = Sucursal::paginate(5);
        }

        return view('pages.sucursal.mostrar',[
            'sucursales' => $sucursal, 'searchText'=>$query
        ]);
    }

    public function insertar(Request $request){
        $sucursal            = new Sucursal();
        $sucursal->nombre    = $request->get('nombre');
        $sucursal->ubicacion    = $request->get('ubicacion');
        $sucursal->save();

        return redirect('/sucursal/mostrar');

    }
    public function actualizar(Request $request){
        $sucursal            = Sucursal::findOrFail($request->id);
        $sucursal->nombre    = $request->get('nombre');
        $sucursal->ubicacion    = $request->get('ubicacion');
        $sucursal->update();


        return redirect('/sucursal/mostrar');
    }
    public function eliminar(Request $request){
        $sucursal             = Sucursal::findOrFail($request->id);
        $sucursal->delete();

        return redirect('/sucursal/mostrar');
    }
}
