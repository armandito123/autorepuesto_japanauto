<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Cliente;



class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
        // return $data;
        $usuario = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'rol'      => 'cliente',
                'avatar'   => 'imagenes/users.png'
            ]);

        $cliente = new Cliente();
        $cliente->id = $usuario->id;
        $cliente->nombre = $data['nombre'];
        $cliente->apellidos = $data['apellidos'];
        $cliente->telefono = $data['telefono'];
        $cliente->correo = $data['email'];
        $cliente->save();

        $usuario->assignRole('cliente');

        $carrito = new Carrito();
        $carrito->monto = 0;
        $carrito->estado = 0;
        $carrito->idCliente = $cliente->id;
        $carrito->save();

        return $usuario;
    }
}
