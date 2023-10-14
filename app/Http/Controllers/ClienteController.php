<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function mostrar(Request $request){
        $cliente=Cliente::all();
        if($request){
            $query = trim($request->get('searchText'));
            $cliente = Cliente::select('id','nombre','apellidos','telefono','correo')
            ->where('nombre','LIKE','%'.$query.'%')
            ->paginate(5);
        }else{
            $cliente = Cliente::paginate(5);
        }

        return view('pages.cliente.mostrar',[
            'clientes' => $cliente, 'searchText'=>$query
        ]);
    }
    public function insertar(Request $request){
        $cliente            = new Cliente();
        $cliente->nombre    = $request->get('nombre');
        $cliente->apellidos    = $request->get('apellidos');
        $cliente->telefono    = $request->get('telefono');
        $cliente->correo    = $request->get('correo');

        $cliente->save();
        $bitacora = Bitacora::guardar('cliente','guardar',$cliente->id);
        return redirect('/cliente/mostrar')->with('success','Guardado exitosamente');
    }
    public function actualizar(Request $request){
        $cliente            = Cliente::findOrFail($request->id);
        $cliente->nombre    = $request->get('nombre');
        $cliente->apellidos    = $request->get('apellidos');
        $cliente->telefono    = $request->get('telefono');
        $cliente->correo    = $request->get('correo');

        $cliente->update();
        $bitacora = Bitacora::guardar('cliente','modificar',$cliente->id);
        return redirect('/cliente/mostrar')->with('success','Guardado exitosamente');
    }
    public function eliminar(Request $request){
        $cliente             = Cliente::findOrFail($request->id);
        $cliente->delete();
        $bitacora = Bitacora::guardar('cliente','eliminar',$cliente->id);


        return redirect('/cliente/mostrar')->with('danger','Eliminado exitosamente');;
    }
}
