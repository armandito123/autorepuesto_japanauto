<?php

namespace App\Http\Livewire;

use App\Models\RepuestoAlmacen;
use App\Models\Carrito;
use App\Models\DetalleNotaCarrito;
use App\Models\DetalleNotaPedido;
use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class ClientePedidos extends Component
{
    public $idUser;
    use WithPagination;
    public $plazo = 5;

    public $hora;
    public $minuto;
    public $segundo;

    public function render()
    {

        return view('livewire.cliente-pedidos', [
            'pedidos' => Pedido::join('clientes', 'clientes.id', '=', 'pedido.idCliente')
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
                ->where('clientes.id', '=', $this->idUser)
                ->orderBy('pedido.id', 'asc')
                ->paginate(),
        ]);
    }

    public function mount($idUser)
    {
        $this->idUser = $idUser;
    }

    public function desconponerHora($date)
    {
        $sub = substr($date, 3, 5);

        $H = substr($date, 0, 2);
        $i = substr($sub, 0, 2);
        $s = substr($date, 6, 8);

        return [
            'hora' => $H,
            'minuto' => $i,
            'segundo' => $s,
        ];
    }
    //Sumar numeros
    public function sumar($n1, $n2)
    {
        return $n1 + $n2;
    }
    public function restar($n1, $n2)
    {
        return $n1 - $n2;
    }

    public function compararConcatear($date)
    {
        $result = "";
        if ($date < 10) {
            $result = "0$date";
        } else {
            $result = "$date";
        }
        return $result;

    }
    public function stringHora($hora, $minuto, $segundo)
    {

        $H = $this->compararConcatear($hora);
        $i = $this->compararConcatear($minuto);
        $s = $this->compararConcatear($segundo);

        return $H . ":" . $i . ":" . $s;
    }
    public function formato($string)
    {
        $str = strtotime($string);

        $formateo = date('H:i:s', $str);

        return $formateo;
    }

    public function sumarMinutos($min1, $min2)
    {
        $suma = $this->sumar($min1, $min2);
        $minuto = 0;
        $reciduo = 0;

        if ($suma < 60) {
            $minuto = $suma;
            $reciduo = 0;
        } else {

            if ($suma == 60) {
                $minuto = 0;
                $reciduo = 1;
            } else {
                $minuto = $this->restar($suma, 60);
                $reciduo = 1;
            }
        }

        return [
            'minuto' => $minuto,
            'reciduo' => $reciduo,
        ];
    }

    public function cancelarPedido($idPedido)
    {
        $fecha = date('Y-m-d');
        $pedido = Pedido::findOrFail($idPedido);
        $idCliente = $pedido->idCliente;

        if ($fecha != $pedido->fechaEntrega) {
            $this->emitir('success', "Lo sentimos. Ya no puede cancelar el pedido");
        } else {

            $arrayDate = $this->desconponerHora($pedido->hora);
            $H = $arrayDate['hora'];
            $i = $arrayDate['minuto'];
            $s = $arrayDate['segundo'];

            $plazo = $this->plazo;

            $sumar = $this->sumarMinutos($i, $plazo);

            $this->hora = $this->sumar($sumar['minuto'], $H);
            $this->minuto = $sumar['minuto'];
            $this->segundo = $s;

            $stringHora = $this->stringHora($this->hora, $this->minuto, $this->segundo);
            $horaCondicion = $this->formato($stringHora);

            $horaActual = date('H:i:s');

            if ($horaActual > $horaCondicion) {
                $this->emitir("success", "Lo sentimos .. No se puede Cancelar el pedido");
            } else {
                $this->updateEstadoPedido($idPedido,3);
                $this->updateDetallePedidoRecorrer($idPedido);
                $this->updateEstadoCarrito($this->getIdCarrito($idCliente));
                $this->updateDetalleCarritoRecorrer($this->getIdCarrito($idCliente));
                $this->emitir("success", "El Pedido ha sido cancelado");
            }
        }

    }

    //Modificara el estado del pedido al valor que le des
    public function updateEstadoPedido($idPedido, $estado)
    {
        $pedido = Pedido::findOrFail($idPedido);
        $pedido->estado = $estado;
        $pedido->montoTotal = 0;
        $pedido->update();
    }

    public function updateDetallePedido($idDetallePedido)
    {
        $objecto = DetalleNotaPedido::findOrFail($idDetallePedido);
        $objecto->cantidad = 0;
        $objecto->subTotal = 0;
        $objecto->idRepuestoAlmacen = null;
        $objecto->update();
    }

    // Cambiara el almacen de referencia a null en el detalle del pedido
    public function updateDetallePedidoRecorrer($idPedido)
    {
        $detallePedido = DetalleNotaPedido::where('idpedido', '=', $idPedido)
            ->get();
        foreach ($detallePedido as $key => $objecto) {

            $this->updateStockRepuestoAlmacen($objecto->idRepuestoAlmacen, $objecto->cantidad);
            $this->updateDetallePedido($objecto->id);
        }

    }

    public function updateDetalleCarritoRecorrer($idCarrito)
    {
        $detalleCarrito = DetalleNotaCarrito::where('idCarrito', '=', $idCarrito)
            ->get();
        foreach ($detalleCarrito as $key => $objecto) {
            $this->updateDetalleCarrito($objecto->id);
        }
    }

    //Modifica el stock del almacen ;
    public function updateStockRepuestoAlmacen($idRepuestoAlmacen, $cantidad)
    {
        $repuestoAlmacen = RepuestoAlmacen::findOrFail($idRepuestoAlmacen);
        $repuestoAlmacen->stock = $cantidad + $repuestoAlmacen->stock;
        $repuestoAlmacen->update();
    }

    public function updateEstadoCarrito($idCarrito)
    {
        $carrito = Carrito::findOrFail($idCarrito);
        $carrito->estado = 0;
        $carrito->update();
    }

    public function updateDetalleCarrito($idDetalleCarrito)
    {
        $detalleCarrito = DetalleNotaCarrito::findOrFail($idDetalleCarrito);
        $detalleCarrito->refPedido = null;
        $detalleCarrito->estado = 0;
        $detalleCarrito->update();
    }

    public function getIdCarrito($idCliente){
        $carrito = Carrito::where('idCliente','=',$idCliente)
        ->get();
        return $carrito[0]->id;

    }

    public function emitir($tipo, $message)
    {
        $data = [$tipo, $message];
        $this->emit('message', $data);
    }
}
