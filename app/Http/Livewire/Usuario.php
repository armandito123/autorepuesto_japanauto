<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Repartidor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Usuario extends Component
{
    use WithPagination;
    public $searchText;
    protected $paginationTheme = 'bootstrap';

    public $p;
    public $usuario;
    public $name;
    public $email;
    public $password;
    public $rol;
    public $nombre;
    public $apellidos;
    public $telefono;
    public $numeroLicencia;
    public $idAuth;

    public function mount($idAuth)
    {
        $this->rol = 'cliente';
        $this->idAuth = $idAuth;
    }
    public function render()
    {
        $searchText = '%' . $this->searchText . '%';
        $usuarios = $this->cargarUsuarios($searchText);

        return view('livewire.usuario', [
            'usuarios' => $usuarios,
        ]);
    }

    public function cargarUsuarios($searchText)
    {
        $usuarios = User::select('id', 'name', 'email', 'password', 'rol')
            ->where('name', 'LIKE', '%' . $searchText . '%')
            ->paginate(10);
        return $usuarios;
    }
    public function resetear()
    {
        $this->usuario = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->nombre = null;
        $this->apellidos = null;
        $this->telefono = null;
        $this->numeroLicencia = null;
    }
    public function updateUsuario($id)
    {

        $stateUser = false;
        $statePerson = false;

        $usuario = User::findOrFail($id);
        if ($this->name != '' && !is_null($this->name)) {
            $usuario->name = $this->name;
            $stateUser = true;
        }
        if ($this->password != '' && !is_null($this->password)) {
            $usuario->password = Hash::check($this->password);
            $stateUser = true;
        }
        if ($this->email != '' && !is_null($this->email)) {
            $usuario->email = $this->email;
            $stateUser = true;
        }

        if ($usuario->rol == 'cliente') {

            $cliente = Cliente::findOrFail($id);

            if (!is_null($this->nombre) && $this->nombre != '') {
                $cliente->nombre = $this->nombre;
                $statePerson = true;
            }
            if (!is_null($this->apellidos) && $this->apellidos != '') {
                $cliente->apellidos = $this->apellidos;
                $statePerson = true;
            }
            if (!is_null($this->telefono) && $this->telefono != '') {
                $cliente->telefono = $this->telefono;
                $statePerson = true;
            }
            if (!is_null($this->email) && $this->email != '') {
                $cliente->correo = $this->email;
                $statePerson = true;
            }

            if ($statePerson) {
                $bitacora = Bitacora::guardar('repartidores', 'update', $cliente->id);
                $cliente->update();

                $this->emitir('success', 'Modificado Correctamente');
            } else {
                $this->emitir('warning', 'El cliente no ha sido actualizado');
            }
        }
        if ($usuario->rol == 'repartidor') {
            $repartidor = Repartidor::findOrFail($id);

            if (!is_null($this->nombre) && $this->nombre != '') {
                $repartidor->nombre = $this->nombre;
                $statePerson = true;
            }
            if (!is_null($this->apellidos) && $this->apellidos != '') {
                $repartidor->apellidos = $this->apellidos;
                $statePerson = true;
            }
            if (!is_null($this->telefono) && $this->telefono != '') {
                $repartidor->telefono = $this->telefono;
                $statePerson = true;
            }
            if (!is_null($this->email) && $this->email != '') {
                $repartidor->correo = $this->email;
                $statePerson = true;
            }
            if (!is_null($this->numeroLicencia) && $this->numeroLicencia != '') {
                $repartidor->numeroLicencia = $this->numeroLicencia;
                $statePerson = true;
            }

            if ($statePerson) {
                $repartidor->update();
                $bitacora = Bitacora::guardar('repartidores', 'update', $repartidor->id);
                $this->emitir('success', 'Modificado Correctamente');
            } else {
                $this->emitir('warning', 'El repartidor no ha sido actualizado');
            }
        }


        if ($stateUser) {
            $usuario->update();
            $bitacora = Bitacora::guardar('users', 'update', $id);
            $this->emitir('success', 'Usuario Modificado Correctamente');
        } else {
            $this->emitir('warning', 'El usuario no ha sido actualizado');
        }

        $this->resetear();
    }
    public function guardarUsuario()
    {

        $usuario = new User();
        $usuario->name = $this->name;
        $usuario->email = $this->email;
        $usuario->password = Hash::make($this->password);
        $usuario->rol = $this->rol;
        $usuario->save();

        $usuario->assignRole($this->rol);
        $bitacora = Bitacora::guardar('users', 'save', $usuario->id);

        if ($this->rol == 're$repartidor') {
            $cliente = new Cliente();
            $cliente->id = $usuario->id;
            $cliente->nombre = $this->nombre;
            $cliente->apellidos = $this->apellidos;
            $cliente->telefono = $this->telefono;
            $cliente->correo = $this->email;
            $cliente->save();
            $bitacora = Bitacora::guardar('clientes', 'save', $cliente->id);

        }
        if ($this->rol == 'repartidor') {
            $repartidor = new Repartidor();
            $repartidor->id = $usuario->id;
            $repartidor->nombre = $this->nombre;
            $repartidor->apellidos = $this->apellidos;
            $repartidor->correo = $this->email;
            $repartidor->telefono = $this->telefono;
            $repartidor->numeroLicencia = $this->numeroLicencia;
            $repartidor->save();
            $bitacora = Bitacora::guardar('clientes', 'save', $repartidor->id);
        }
        $this->resetear();
        $this->emitir('success', 'Guardado Correctamente');

    }
    public function emitir($tipo, $message)
    {
        $data = [$tipo, $message];
        $this->emit('message', $data);
    }

}
