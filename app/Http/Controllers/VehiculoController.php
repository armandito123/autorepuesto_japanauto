<?php

namespace App\Http\Controllers;

use App\Models\Repartidor;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller{

    public function mostrar(Request $request){
        $vehiculo=  Repartidor::all();

        if($request){
            $query = trim($request->get('searchText'));
            $vehiculo = Vehiculo::select(   'vehiculos.id',
                                            'vehiculos.tipo',
                                            'vehiculos.placa',
                                            'repartidores.nombre',
                                            'repartidores.apellidos')
            ->join('repartidores','repartidores.id','=','vehiculos.idRepartidor')
            ->where('tipo','LIKE','%'.$query.'%')
            ->paginate(10);
        }else{
            $vehiculo = Vehiculo::paginate(10);
        }

        return view('pages.vehiculo.mostrar',[
            'vehiculos' => $vehiculo, 'searchText'=>$query
        ]);
    }

    public function insertar(Request $request){
        $vehiculo                  = new Vehiculo();
        $vehiculo->tipo            = $request->get('tipo');
        $vehiculo->placa           = $request->get('placa');
        $vehiculo->idRepartidor    = $request->get('idRepartidor');
        $vehiculo->save();
        return redirect('/vehiculo/mostrar')->with('status','Guardado correctamente');
    }

    public function actualizar(Request $request){
        $vehiculo                  = Vehiculo::findOrFail($request->id);
        $vehiculo->tipo            = $request->get('tipo');
        $vehiculo->placa           = $request->get('placa');
        $vehiculo->idRepartidor    = $request->get('idRepartidor');
        $vehiculo->update();
        return redirect('/vehiculo/mostrar');
    }

    public function eliminar(Request $request){
        $vehiculo = Vehiculo::findOrFail($request->id);
        $vehiculo->delete();

        return redirect('/vehiculo/mostrar');
    }
}
