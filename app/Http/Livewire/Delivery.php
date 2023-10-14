<?php

namespace App\Http\Livewire;

use App\Models\Repuesto;
use App\Models\RepuestoAlmacen;
use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\DetalleNotaCarrito;
use App\Models\DetalleNotaPedido;
use App\Models\MarcaModelo;
use App\Models\Pedido;
use App\Models\Repartidor;
use Livewire\Component;
use Livewire\WithPagination;

class Delivery extends Component
{

    // public $carritoDetalleSeleccionado;
    use WithPagination;


    public $searchText;



    public $carritoSeleccionado;
    public $pedidoSeleccionado;
    public $clienteSeleccionado;
    public $repuestoSeleccionado;
    public $almacenSeleccionado;



    public $pedidoDetalleSeleccionado;



    public $opcionAlmacen = false;
    public $opcionRepartidor =  false;


    public $cantidad = 0;
    public $refPedido;



    public $idCliente;
    public $idCarrito;
    public $idPedido;
    public $idRepuesto;
    public $idAlmacen;

    public $idRepuestoAlmacen;
    public $idDetalleCarrito;
    public $idDetallePedido;




    public $opcion = false;



    public function render(){


        $searchText = '%'.$this->searchText.'%';
        $pedidos = $this->coleccionPedidos($searchText);
        $repartidores = $this->coleccionRepartidores();

        $idRepuesto = $this->idRepuesto;


        $arrayCarritoDetalleSeleccionado = [];
        $arrayRepuestoAlmacen = [];


        if($this->idCarrito){
            $arrayCarritoDetalleSeleccionado = $this->coleccionCarritoDetalleSeleccionado($this->idCarrito);
        }

        if ($idRepuesto) {
            $arrayRepuestoAlmacen = Repuesto::
            join('repuesto_almacen','repuesto_almacen.idRepuesto','=','repuestos.id')
            ->join('almacenes','repuesto_almacen.idAlmacen','=','almacenes.id')
            ->where('repuestos.id','=',$idRepuesto)->get();
        }



        return view('livewire.delivery',[
            'repartidores' => $repartidores ,
            'pedidos' => $pedidos,
            'carritoDetalleSeleccionado'=>$arrayCarritoDetalleSeleccionado,
            'repuestoalmacen' => $arrayRepuestoAlmacen
        ]);
    }
    public function coleccionPedidos($searchText){
        $pedidos =Pedido::join('clientes','clientes.id','=','pedido.idCliente')
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
            ->paginate(10);

        return $pedidos;
    }

    public function coleccionRepartidores(){
        $repartidores = Repartidor::paginate(10);
        return $repartidores;
    }

    //Para seleccionar el repartido que entregara el pedido
    public function seleccionarRepartidor($idPedido,$idRepartidor){

        $vari = "modal-seleccionar-repartidor".$idPedido;
        // dd($vari);
        $pedido = Pedido::findOrFail($idPedido);
        $pedido->idRepartidor = $idRepartidor;
        $pedido->update();
        $this->emit("cerrarmodalrepartidor",$vari);
        $this->emitir('success','Repartidor seleccionado');
        
    }


    public function coleccionCarritoDetalleSeleccionado($id){
        $carritoDetalleSeleccionado = Carrito::select(
            'repuestos.id as idRepuesto',
            'repuestos.descripcion',
            'repuestos.codigo',
            'repuestos.precioVenta',
            'repuestos.precioCompra',
            'repuestos.imagen',
            'repuestos.idCategoria',
            'repuestos.idMarcaModelo',
            'repuestos.idTipoRepuesto',
            'detallecarrito.cantidad',
            'detallecarrito.medida',
            'detallecarrito.submedida',
            'detallecarrito.estado as estadoDetalle',
            'detallecarrito.idCarrito',
            'detallecarrito.refPedido',
            'detallecarrito.id as idDetalleCarrito',
            'carrito.estado as estadoCarrito',
            'carrito.monto',
            'carrito.id',
        )
        ->join('detallecarrito','detallecarrito.idCarrito','=','carrito.id')
        ->join('repuestos','detallecarrito.idRepuesto','=','repuestos.id')
        ->where('carrito.id','=',$id)
        // ->where('detallecarrito.estado','=',1)
        ->get();

        return $carritoDetalleSeleccionado;
    }



    public function coleccionPedidoSolicitado($id){
        $pedidoDetalleSeleccionado = Pedido::
        join('detalle_pedido','detalle_pedido.idPedido','=','pedido.id')
        ->where('pedido.id','=',$id)
        ->where('pedido.estado','=',0)
        ->get();

        return  $pedidoDetalleSeleccionado;
    }

    public function carritoSeleccionado($idCliente){
        $carritoSeleccionado = Carrito::where('idCliente','=',$idCliente)->get();
        return $carritoSeleccionado[0];
    }




    public function atenderRepuestoAlmacen($idRepuesto,$cantidad,$idDetalleCarrito,$refPedido){


        $this->opcionAlmacen = true;
        $this->idRepuesto =  $idRepuesto;
        $this->cantidad = $cantidad;
        $this->refPedido = $refPedido;
        $this->idDetalleCarrito = $idDetalleCarrito;
        $this->emitir('success',"Seleccione de que almacen desea obtener el repuesto $idDetalleCarrito");
    }
    public function atenderPedido($idPedido,$idCliente){


        //Pedido Cliente Carrito
        $this->clienteSeleccionado = Cliente::findOrFail($idCliente);
        $this->pedidoSeleccionado = Pedido::findOrFail($idPedido);
        $this->carritoSeleccionado = $this->carritoSeleccionado($idCliente);

        // $this->pedidoDetalleSeleccionado = $this->pedidoSolicitado($idPedido);


        $this->idCliente = $idCliente;
        $this->idCarrito = $this->carritoSeleccionado->id;
        $this->idPedido = $idPedido;

        $this->opcion = true;
        $this->emitir('success','Selecciona el repuesto de los almacenes');
    }
    public function verListaPedido(){
        $this->opcion = false;
    }
    public function buscarRepuesto($idRepuesto,$cantidad){
        $this->cantidad = $cantidad;

        $repuesto  = Repuesto::findOrFail($idRepuesto);

        $marcaModelo  = MarcaModelo::join('repuestos','repuestos.idMarcaModelo','=','marca_modelos.id')
        ->where('repuestos.id','=',$repuesto->id)
        ->get();




        $repuestoAlmacen  = RepuestoAlmacen::join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
        ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        ->join('categorias','categorias.id','=','repuestos.idCategoria')
        ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
        ->select('repuestos.id as idRepuesto',
                 'repuesto_almacen.idAlmacen as idAlmacen',
                 'repuesto_almacen.id as idRepuestoAlmacen',
                 'repuesto_almacen.stock',
        )
        ->where('categorias.id','=',$repuesto->idCategoria)
        ->where('tipo_repuestos.id','=',$repuesto->idTipoRepuesto)
        ->where('marca_modelos.idMarca','=',$marcaModelo[0]->idMarca)
        ->where('repuestos.descripcion','LIKE','%'.$repuesto->descripcion.'%')->get();
        $this->arrayRepuesto = $repuestoAlmacen;
    }
    public function venderRepuesto($idRepuestoAlmacen){
        $repuestoAlmacen = RepuestoAlmacen::findOrFail($idRepuestoAlmacen);
        $repuestoAlmacen->stock = $repuestoAlmacen->stock - $this->cantidad;
        $repuestoAlmacen->update();

        $message = "Repuesto seleccionado";
        $this->emit('message',$message);
    }

    public function emitir($tipo,$message){
        $data = [$tipo, $message];
        $this->emit('message', $data);
    }

    //Para los repuestos solicitados
    public function verRepuestosSolicitados(){
        $this->opcionAlmacen = false;
    }

    //Para obtener el repuesto almacen
    public function getRepuestoAlmacen($idRepuesto,$idAlmacen){
        $repuestoAlmacen = RepuestoAlmacen::
        where('idRepuesto','=',$idRepuesto)
        ->where('idAlmacen','=',$idAlmacen)->get();

        return $repuestoAlmacen[0];
    }

    public function updateStockRepuestoAlmacen($cantidad,$idRepuestoAlmacen){
        $repuestoAlmacen = RepuestoAlmacen::FindOrFail($idRepuestoAlmacen);
        $repuestoAlmacen->stock = $repuestoAlmacen->stock - $cantidad;
        $repuestoAlmacen->update();
    }




    //Para modificar el estado de detalle carrito
    public function updateEstadoDetalleCarrito(){
        $detalleCarrito = DetalleNotaCarrito::findOrFail($this->idDetalleCarrito);
        $detalleCarrito->estado = 2;
        $detalleCarrito->update();
    }
    public function functionExisteRepuestoSinAtender(){
        $sw = false;
        $idCliente = $this->idCliente;
        $carrito = $this->carritoSeleccionado($idCliente);
        $detalleCarrito = DetalleNotaCarrito::where('idCarrito','=',$carrito->id)
        ->get();


        foreach ($detalleCarrito as $key => $carrito) {
            if ($carrito->estado == 1) {
                $sw = true;
            }
        }

        return $sw;

    }

    public function updateDetallePedidoIdRepuestoAlmacen($refPedido,$idRepuestoAlmacen){
        $detallePedido = DetalleNotaPedido::findOrFail($refPedido);
        $detallePedido->idRepuestoAlmacen = $idRepuestoAlmacen;
        $detallePedido->update();
    }

    //Para que solicite el pedido
    public function obtenerRepuestoDelAlmacen($idRepuesto,$idAlmacen,$stock){
        $cantidad = $this->cantidad;
        $refPedido = $this->refPedido;

        if(!$this->functionExisteRepuestoSinAtender()){
            $pedido = Pedido::findOrFail($this->idPedido);
            $pedido->estado= 1;
            $pedido->update();
        }
        if($stock > $cantidad){

            $this->updateEstadoDetalleCarrito();
            $repuestoAlmacen = $this->getRepuestoAlmacen($idRepuesto,$idAlmacen);
            $this->updateStockRepuestoAlmacen($cantidad,$repuestoAlmacen->id);
            $this->updateDetallePedidoIdRepuestoAlmacen($refPedido,$repuestoAlmacen->id);

            $this->emitir('success',"El Repuesto a sido seleccionado");
            $this->opcionAlmacen = false;
        }else{
            $this->emitir('danger','El Stock es insuficiente');
        }
    }
}
