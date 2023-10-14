<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ClienteController;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Repartidor;
use Facade\FlareClient\Http\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class AgregarUsuario extends Component
{
    // use WithPagination;

    public $usuario;


    public $name;
    public $email;
    public $password;

    public $rol;

    public $nombre;
    public $apellidos;
    public $telefono;
    public $numeroLicencia;
    
    public function render()
    {
        return view('livewire.agregar-usuario');
    }

    public function guardarUsuario(){
        
        $usuario            = new User();
        $usuario->name    = $this->name;
        $usuario->email    = $this->email;
        $usuario->password    =Hash::make($this->password) ;
        $usuario->rol    = $this->rol;
        $usuario->save();

        $usuario->assignRole($this->rol);

        if($this->rol=='cliente'){
            $cliente            = new Cliente();
            $cliente->nombre    = $this->nombre;
            $cliente->apellidos    = $this->apellidos;
            $cliente->telefono    = $this->telefono;
            $cliente->correo    = $this->email;
            $cliente->save();
        }
        if ($this->rol=='repartidor') {
            $repartidor            = new Repartidor();
            $repartidor->nombre    = $this->nombre;
            $repartidor->apellidos    = $this->apellidos;
            $repartidor->correo        = $this->email;
            $repartidor->telefono     = $this->telefono;
            $repartidor->numeroLicencia    = $this->numeroLicencia;
            $repartidor->save();
    
        }
        $this->final = true;

    }
}
