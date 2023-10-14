<?php

namespace App\Http\Livewire;

use App\Models\Pedido;
use Livewire\Component;

class DetallePedido extends Component
{
    public $searchText ;
    public function render()

    {
        $searchText = '%'.$this->searchText.'%';
        return view('livewire.detalle-pedido', [

            'pedidos' => Pedido::join('repartidores','repartidores.id','=','pedido.idRepartidor')
            ->join('clientes','clientes.id','=','pedido.idCliente')
            ->select(
                "pedido.id",
                "pedido.fecha",
                "pedido.fechaentrega",
                "pedido.hora",
                "pedido.horaentrega",
                "pedido.tiempoentrega",
                "pedido.montoTotal",
                "pedido.estado",
                "pedido.idUbicacion",
                "pedido.idRepartidor",
                "pedido.idCliente",
            )
            ->orderBy('pedido.id','desc')
            ->where('clientes.nombre','LIKE','%'.$searchText.'%')
            ->paginate(10)
        ]);
    }
}
