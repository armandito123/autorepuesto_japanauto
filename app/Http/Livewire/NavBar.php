<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavBar extends Component
{
    protected $listeners = ['entregarPedido' =>'alertar'];
    public $idPedido;


    public function render()
    {

        $this->emitir('message','Renderizado exitosamente');

        return view('livewire.nav-bar');
    }
    public function alertar($idpedido){
        $this->emitir('message','Renderizado exitosamente');

        $this->render();
    }
    public function emitir($tipo,$message){
        $data = [$tipo, $message];
        $this->emit('message', $data);
    }
}
