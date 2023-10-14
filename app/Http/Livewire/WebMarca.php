<?php

namespace App\Http\Livewire;

use App\Models\Repuesto;
use App\Models\Carrito;
use App\Models\DetalleCarrito;
use Livewire\Component;

class WebMarca extends Component
{
    public $marca;
    public $searchText;
    public $atributo ="";
    public $criterio ="repuestos";
    public $eldy='mensaje';
    public $x= true;
    public $cantidad;
    public $medida;
    public $submedida;
    public $total =0;

    

    public function render(){
        $criterio = $this->criterio;
        $atributo = "";
        $idMarca = $this->marca->id;
        $searchText = "%".$this->searchText."%";
        if($criterio=='repuestos'){$this->atributo = 'descripcion';}
        if($criterio=='categorias'){$this->atributo = 'nombre';}
        if($criterio=='tipo_repuestos'){$this->atributo = 'tipo';}

        $atributo = $this->atributo;

        $repuesto = Repuesto::select(
            "repuestos.id as idRepuesto",
            "repuestos.descripcion",
            "repuestos.precioVenta as precio",
            "repuestos.imagen as img",
            "repuestos.idMarcaModelo",
            "tipo_repuestos.tipo",
            "categorias.nombre as categoria",
            "marcas.nombre as marca",
            "marcas.id as idMarca",
            "categorias.id as idCategoria",
            "modelos.nombre as modelo",
            "modelos.id as idModelo",
        )
        ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        ->join('categorias','categorias.id','=','repuestos.idCategoria')
        ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
        ->join('marcas','marcas.id','=','marca_modelos.idMarca')
        ->join('modelos','modelos.id','=','marca_modelos.idModelo')
        ->where('marcas.id','=',$idMarca)
        ->where($criterio.'.'.$atributo,'LIKE','%'.$searchText.'%')
        ->get();

        if(!$repuesto){
            $repuesto = Repuesto::select(
                "repuestos.id as idRepuesto",
                "repuestos.descripcion",
                "repuestos.precioVenta as precio",
                "repuestos.imagen as img",
                "repuestos.idMarcaModelo",
                "tipo_repuestos.tipo",
                "categorias.nombre as categoria",
                "marcas.nombre as marca",
                "marcas.id as idMarca",
                "categorias.id as idCategoria",
                "modelos.nombre as modelo",
                "modelos.id as idModelo",
            )
            ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
            ->join('categorias','categorias.id','=','repuestos.idCategoria')
            ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
            ->join('marcas','marcas.id','=','marca_modelos.idMarca')
            ->join('modelos','modelos.id','=','marca_modelos.idModelo')
            ->where('marcas.id','=',$idMarca)
            ->get();    
        }


        return view('livewire.web-marca',[
            'repuestos' => $repuesto  ]);
    }
    public function mount($marca){
        $this->marca = $marca;
    }
    public function mostrar(){
        $this->x = true;
    }
    public function ocultar(){
        $this->x = false;
    }
    public function seleccionarRepuesto($id){
        $this->idRepuesto = $id;
    }
    public function añadirRepuesto($idCliente,$idRepuesto){
        if (!is_null($this->medida) && !is_null($this->submedida) && !is_null($this->cantidad) ) {
            $carrito = Carrito::select('carrito.id')
            ->join('clientes','clientes.id','=','carrito.idCliente')
            ->where('carrito.idCliente','=',$idCliente)->get();

            $idCarrito = $carrito[0]->id;


            $detalle =  new DetalleCarrito();
            $detalle->cantidad = $this->cantidad;
            $detalle->medida = $this->medida;
            $detalle->submedida = $this->submedida;
            $detalle->idRepuesto = $idRepuesto;
            $detalle->idCarrito = $idCarrito;
            $detalle->save();

            $repuesto = Repuesto::findOrFail($detalle->idRepuesto);
            
            $carrito= Carrito::findOrFail($detalle->idCarrito);
            $carrito->monto = $carrito->monto +  ($detalle->cantidad * $repuesto->precioVenta);
            $carrito->update();


            $message = "Guardado Exitosamente";
            $this->emit('message',$message);


            $this->emit('actualizarDetalle');
        }else{
            $message = "Complete el campo correctamente";
            $this->emit('message',$message);
        }
        
    }
    public function opcion($op){
        if ($op == 1) {
            $this->eldy='login';
        }

        if ($op == 2) {
            $this->eldy='registro';
            
        }
    }

}
