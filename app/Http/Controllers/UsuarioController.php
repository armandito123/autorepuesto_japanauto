<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Carrito;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Repartidor;
use Illuminate\Support\Facades\Hash;



class UsuarioController extends Controller
{

    public function mostrar(Request $request){
        $usuario=User::all();
        if($request){
            $query = trim($request->get('searchText'));
            $usuario = User::select('id','name','email','password','rol')
            ->where('name','LIKE','%'.$query.'%')
            ->paginate(5);
        }else{
            $usuario = User::paginate(10);
        }

        return view('pages.usuario.mostrar',[
            'usuarios' => $usuario, 'searchText'=>$query
        ]);
    }

    public function insertar(Request $request){

        $usuario            = new User();
        $usuario->name    = $request->get('name');
        $usuario->email    = $request->get('email');
        $usuario->password    =Hash::make($request->get('password')) ;
        $usuario->rol    = $request->get('rol');
        $usuario->save();

        $usuario->assignRole($request->get('rol'));

        if($request->get('rol')=='cliente'){
            $cliente            = new Cliente();
            $cliente->nombre    = $request->get('nombre');
            $cliente->apellidos = $request->get('apellidos');
            $cliente->telefono  = $request->get('telefono');
            $cliente->email    = $request->get('correo');
            $cliente->save();

            $carrito = new Carrito();
            $carrito->monto = 0;
            $carrito->estado = 0;
            $carrito->idCliente = $cliente->id;
            $carrito->save();
        }
        if ($request->get('rol')=='repartidor') {
            $repartidor            = new Repartidor();
            $repartidor->nombre    = $request->get('nombre');
            $repartidor->apellidos    = $request->get('apellidos');
            $repartidor->email    = $request->get('correo');
            $repartidor->telefono    = $request->get('telefono');
            $repartidor->numeroLicencia    = $request->get('numeroLicencia');
            $repartidor->save();

        }
        return redirect('/usuario/mostrar');

    }
    public function actualizar(Request $request){
        $usuario            = User::findOrFail($request->id);
        $usuario->name    = $request->get('name');
        $usuario->email    = $request->get('email');
        $usuario->password    = $request->get('password');
        $usuario->rol    = $request->get('rol');

        $usuario->update();

        $usuario->assignRole($request->get('rol'));

        $cliente            = Cliente::findOrFail();
        $cliente->nombre    = $request->get('nombre');
        $cliente->apellidos    = $request->get('apellidos');
        $cliente->telefono    = $request->get('telefono');
        $cliente->correo    = $request->get('email');

        $cliente->update();

        $repartidor            = Repartidor::findOrFail();
        $repartidor->nombre    = $request->get('nombre');
        $repartidor->apellidos    = $request->get('apellidos');
        $repartidor->correo    = $request->get('correo');
        $repartidor->telefono    = $request->get('telefono');
        $repartidor->numeroLicencia    = $request->get('numeroLicencia');

        $repartidor->update();


        return redirect('/usuario/mostrar');
    }
    public function eliminar(Request $request){
        $usuario             = User::findOrFail($request->id);
        $usuario->delete();

        return redirect('/usuario/mostrar');
    }


    public function bitacora(){
        $bitacora = Bitacora::paginate(100);
        return view('pages.bitacora.index',[
            "bitacoras" => $bitacora
        ]);
    }

}
