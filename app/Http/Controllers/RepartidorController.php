<?php

namespace App\Http\Controllers;
use App\Models\Repartidor;
use Illuminate\Http\Request;

class RepartidorController extends Controller
{
    public function mostrar(Request $request){
        $repartidor=Repartidor::all();
        if($request){
            $query = trim($request->get('searchText'));
            $repartidor = Repartidor::select('id','nombre','apellidos','correo','telefono','numeroLicencia')
            ->where('nombre','LIKE','%'.$query.'%')
            ->paginate(5);
        }else{
            $repartidor = Repartidor::paginate(1);
        }

        return view('pages.repartidor.mostrar',[
            'repartidores' => $repartidor, 'searchText'=>$query
        ]);
    }

    public function detalle(){
        
    }
    public function insertar(Request $request){
        $repartidor            = new repartidor();
        $repartidor->nombre    = $request->get('nombre');
        $repartidor->apellidos    = $request->get('apellidos');
        $repartidor->correo    = $request->get('correo');
        $repartidor->telefono    = $request->get('telefono');
        $repartidor->numeroLicencia    = $request->get('numeroLicencia');

        $repartidor->save();

        return redirect('/repartidor/mostrar');

    }
    public function actualizar(Request $request){
        $repartidor            = Repartidor::findOrFail($request->id);
        $repartidor->nombre    = $request->get('nombre');
        $repartidor->apellidos    = $request->get('apellidos');
        $repartidor->correo    = $request->get('correo');
        $repartidor->telefono    = $request->get('telefono');
        $repartidor->numeroLicencia    = $request->get('numeroLicencia');

        $repartidor->update();


        return redirect('/repartidor/mostrar');
    }
    public function eliminar(Request $request){
        $repartidor             = Repartidor::findOrFail($request->id);
        $repartidor->delete();

        return redirect('/repartidor/mostrar');
    }
}
