<?php

namespace App\Http\Livewire;

use App\Models\Venta;
use Livewire\Component;

class DetalleVenta extends Component
{
    public $searchText ;
    public function render()
    {
        $searchText = '%'.$this->searchText.'%';
        return view('livewire.venta.detalle-venta',
            [
                'ventas' => Venta::join('users','users.id','=','nota_venta.idUser')
                ->join('clientes','clientes.id','=','nota_venta.idCliente')
                ->select('nota_venta.id',
                         'clientes.nombre',
                         'clientes.apellidos',
                         'nota_venta.fecha',
                         'nota_venta.montoTotal',
                         'nota_venta.idCliente',
                         'nota_venta.idUser',
                         )
                ->where('clientes.nombre','LIKE','%'.$searchText.'%')
                ->paginate(10)
            ]
        );
    }
}
