<?php

namespace App\Http\Livewire;

use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\Pedido;
use Livewire\Component;

class RepartidorPedidos extends Component
{
    public $idUser;
    public $idCarrito;

    public function render(){

        return view('livewire.repartidor-pedidos',[
            'pedidos' => Pedido::join('repartidores','repartidores.id','=','pedido.idRepartidor')
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
            ->where('repartidores.id','=',$this->idUser)
            ->orderBy('pedido.id', 'asc')
            ->paginate(10)
        ]);

    }
    public function mount( $idUser){
        $this->idUser= $idUser;
    }
    public function repuestosAsignados($idPedido){
        $detallePedido = Pedido::join('detalle_pedido','detalle_pedido.idPedido','=','pedido.id')
        ->join('repuesto_almacen','repuesto_almacen.id','=','detalle_pedido.idRepuestoAlmacen')
        ->join('almacenes','almacenes.id','repuesto_almacen.idAlmacen')
        ->join('repuestos','repuestos.id','repuesto_almacen.idRepuesto')
        ->where('pedidos.id','=',$idPedido)
        ->get();

        return $detallePedido;
    }
    public function updateEstadoCarrito($idCarrito){
        $carrito = Carrito::findOrFail($idCarrito);
        $carrito->estado = 0;
        $carrito->update();
    }

    public function getCarrito($idCliente){
        $carrito = Carrito::where('idCliente','=',$idCliente)->get();
        return $carrito[0];
    }
    public function entregarPedido($idPedido){
        $pedido = Pedido::findOrFail($idPedido);
        $pedido->estado = 2;
        $pedido->update();


        $idCarrito = $this->getCarrito($pedido->idCliente)->id;

        $this->updateEstadoCarrito($idCarrito);






        $this->emitir('success','El Pedido ha sido entregado exitosamente');

        $this->emit('entregarPedido',$idPedido);
    }
    public function emitir($tipo,$message){
        $data = [$tipo, $message];
        $this->emit('message', $data);
    }
}
