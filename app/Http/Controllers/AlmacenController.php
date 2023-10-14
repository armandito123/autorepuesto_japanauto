<?php

namespace App\Http\Controllers;
use App\Models\Almacen;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    public function mostrar(Request $request){
        $almacen=Almacen::all();
        if($request){
            $query = trim($request->get('searchText'));
            $almacen = Almacen::select('id','sigla')
            ->where('sigla','LIKE','%'.$query.'%')
            ->paginate(5);
        }else{
            $almacen = Almacen::paginate(5);
        }

        return view('pages.almacen.mostrar',[
            'almacenes' => $almacen, 'searchText'=>$query
        ]);
    }
    public function insertar(Request $request){
        $almacen            = new almacen();
        $almacen->sigla    = $request->get('sigla');
        $almacen->save();

        return redirect('/almacen/mostrar');

    }
    public function actualizar(Request $request){
        $almacen            = Almacen::findOrFail($request->id);
        $almacen->sigla    = $request->get('sigla');
        $almacen->update();


        return redirect('/almacen/mostrar');
    }
    public function eliminar(Request $request){
        $almacen             = Almacen::findOrFail($request->id);
        $almacen->delete();

        return redirect('/almacen/mostrar');
    }
}
