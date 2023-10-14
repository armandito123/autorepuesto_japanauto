<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RepuestoDetalle extends Component
{
    public $repuesto;
    public function render()
    {
        return view('livewire.repuesto-detalle');
    }
    public function mount($repuesto){
        $this->repuesto =  $repuesto;
    }
}
