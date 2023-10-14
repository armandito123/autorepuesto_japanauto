<?php

namespace App\Http\Livewire;

use App\Models\Repuesto;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use Livewire\Component;

class WebDetalleCarrito extends Component{

    public $idCarrito;
    public $idCliente;
    public $idRepuesto;
    public $cantidad;
    public $medida;
    public $submedida;

    public $estadoCarrito;


    public $total;
    protected $listeners = [
        'actualizarDetalle' => 'render'
    ];

    public function render(){

        $carrito = Carrito::join('clientes','clientes.id','carrito.idCliente')
        ->join('detallecarrito','detallecarrito.idCarrito','carrito.id')
        ->where("clientes.id","=",$this->idCliente)
        ->get();


        $carrito1 = Carrito::join('clientes','clientes.id','carrito.idCliente')
        ->where("clientes.id","=",$this->idCliente)->get();
        $this->total = $carrito1[0]->monto;


        return view('livewire.web-detalle-carrito',[
            "carrito"=>$carrito
        ]);
    }
    public function mount($idCliente){
        $this->idCarrito = (Carrito::where("idCliente","=",$idCliente)->get())[0]->id;
        $this->estadoCarrito = (Carrito::where("idCliente","=",$idCliente)->get())[0]->estado;
        $this->idCliente = $idCliente;
    }
    public function añadirAlCarrito(){

        $detalle =  new DetalleCarrito();
        $detalle->cantidad = $this->cantidad;
        $detalle->medida = $this->medida;
        $detalle->submedida = $this->submedida;
        $detalle->idRepuesto = $this->idRepuesto;
        $detalle->idCarrito = $this->idCarrito;
        $detalle->save();

        $repuesto = Repuesto::findOrFail($detalle->idRepuesto);
        $this->total = $this->total +  ($detalle->cantidad * $repuesto->precioVenta);

        $carrito= Carrito::findOrFail($detalle->idCarrito);
        $carrito->monto = $this->total;


        $this->emitir('danger','Añadido Exitosamemte');

    }
    public function sumarTotal(){

    }

    public function emitir($tipo,$message){
        $data = [$tipo, $message];
        $this->emit('message', $data);
    }
    public function eliminar($idDetalle){

        $detalle = DetalleCarrito::findOrFail($idDetalle);
        $repuesto = Repuesto::findOrFail($detalle->idRepuesto);
        $this->total = $this->total -  ($detalle->cantidad * $repuesto->precioVenta);

        $carrito= Carrito::findOrFail($detalle->idCarrito);
        $carrito->monto = $this->total;
        $carrito->update();
        $detalle->delete();

        $message = "El registro se ha eliminado";
        $this->emit("message",$message);
    }

}
