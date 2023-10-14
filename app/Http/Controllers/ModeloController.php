<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModeloController extends Controller
{
    public function mostrar(Request $request){
        $modelo=Modelo::all();
        if($request){
            $query = trim($request->get('searchText'));
            $modelo = Modelo::select('id','nombre')
            ->where('nombre','LIKE','%'.$query.'%')
            ->paginate(5);
        }else{
            $modelo = Modelo::paginate(1);
        }

        return view('pages.modelo.mostrar',[
            'modelos' => $modelo, 'searchText'=>$query
        ]);
    }
    public function insertar(Request $request){
        $modelo            = new Modelo();
        $modelo->nombre    = $request->get('nombre');
        if($request->file('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $modelo->logo = $path; 
        }else{
            $modelo->logo = 'imagenes/modelo.png';
        }
        $modelo->save();

        return redirect('/modelo/mostrar');

    }
    public function actualizar(Request $request){
        $modelo            = Modelo::findOrFail($request->id);
        $modelo->nombre    = $request->get('nombre');
        $modelo->update();


        return redirect('/modelo/mostrar');
    }
    public function eliminar(Request $request){
        $modelo             = Modelo::findOrFail($request->id);
        $modelo->delete();

        return redirect('/modelo/mostrar');
    }
}
