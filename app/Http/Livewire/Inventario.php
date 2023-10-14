<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\RepuestoAlmacen;
use Livewire\Component;
use Livewire\WithPagination;

class Inventario extends Component
{
    use WithPagination;
    public $searchText;
    public $transferir = false;

    public $idAlmacenDestino;
    public $idAlmacenOrigen;

    public $idRepuestoAlmacen;

    public $siglaOrigen;
    public $siglaDestino;

    public $estadoOrigen =  false;
    public $estadoDestino = false;

    public $arrayAlmacenOrigen = [];
    public $arrayAlmacenDestino = [];

    public $cantidad;
    public $estadoInput = false;
    public $estadoDisponible = false;

    public function render()
    {

        $this->idRepuestoAlmacen ;
        $idAlmacenDestino = $this->idAlmacenDestino;
        $idAlmacenOrigen  = $this->idAlmacenOrigen;

        $this->getAlmacen($idAlmacenDestino,'destino');
        $this->getAlmacen($idAlmacenOrigen,'origen');

        $this->getAlmacenes($idAlmacenOrigen,$idAlmacenDestino);
        $searchText = '%' . $this->searchText . '%';
        $repuestoAlmacen = $this->getRepuestosAlmacenes($searchText);


        if ($this->idRepuestoAlmacen) {
            if ($this->validarStock($this->idRepuestoAlmacen)) {
                $this->estadoDisponible = true;
            } else {
                $this->estadoDisponible = false;
            }
        }

        return view('livewire.almacen.inventario',

            [
                'repuestoAlmacenes' => $repuestoAlmacen,

            ]
        );
    }



    public function getAlmacenes($idOrigen,$id2){
        if ($idOrigen) {

        }else{
            $this->arrayAlmacenDestino = Almacen::get();;
        }
        // if ($idOrigen) {
        //     $almacen = Almacen::where('id','!=',$id1)->get();
        // } else {
        //     $almacen = Almacen::get();
        //     $this->arrayAlmacenDestino;
        // }

    }



    public function getAlmacen($id,$dato){
        if ($id) {

            if ($dato == 'origen') {
                $almacen = Almacen::findOrFail($id);
                $this->siglaOrigen = $almacen->sigla;
                $this->estadoOrigen = true;
            }
            if ($dato == 'destino') {
                $almacen = Almacen::findOrFail($id);
                $this->siglaDestino = $almacen->sigla;
                $this->estadoDestino= true;

            }
        }
    }

    public function getRepuestosAlmacenes($searchText){
        $repuestoAlmacen = RepuestoAlmacen::select('repuesto_almacen.id',
        'repuesto_almacen.stock',
        'repuestos.descripcion as repuesto',
        'categorias.nombre as categoria',
        'tipo_repuestos.tipo as tipo',
        'marca_modelos.id as idMarcaModelo',
        'marcas.nombre as marca',
        'modelos.nombre as modelo',
        'almacenes.sigla as almacen'
    )
            ->join('repuestos', 'repuestos.id', '=', 'repuesto_almacen.idRepuesto')
            ->join('categorias', 'categorias.id', '=', 'repuestos.idCategoria')
            ->join('tipo_repuestos', 'tipo_repuestos.id', '=', 'repuestos.idTipoRepuesto')
            ->join('marca_modelos', 'marca_modelos.id', '=', 'repuestos.idMarcaModelo')
            ->join('marcas', 'marcas.id', '=', 'marca_modelos.idMarca')
            ->join('modelos', 'modelos.id', '=', 'marca_modelos.idModelo')
            ->join('almacenes', 'almacenes.id', '=', 'repuesto_almacen.idAlmacen')
            ->orWhere('almacenes.sigla', 'LIKE', '%' . $searchText . '%')
            ->orderBy('repuesto_almacen.id', 'asc')
            ->paginate(10);
        return $repuestoAlmacen;
    }


    public function verTransferencia(){
        $this->transferir = true;
    }

    public function emitir($tipo, $message)
    {
        $data = [$tipo, $message];
        $this->emit('message', $data);
    }
    public function mostrarInput($idRepuestoAlmacen){
        $this->estadoInput = true;
        $this->idRepuestoAlmacen = $idRepuestoAlmacen;

    }
    public function validarStock($id)
    {
        $sw = false;
        $repuestoAlmacen = RepuestoAlmacen::findOrFail($id);
        if ($repuestoAlmacen->stock >= $this->cantidad) {
            $sw = true;
        }
        return $sw;
    }
    public function transferirRepuesto(){

        if ($this->cantidad) {
            if ($this->estadoDisponible) {
                if ($this->cantidad < 0) {
                    $this->emitir('danger',"Cantidad no valida");
                }else{

                    if($this->cantidad == 0 ){
                        $this->emitir('danger',"La Cantidad no puede ser cero");

                    }else{
                        $cantidad = $this->cantidad;
                        $idRepuestoAlmacen = $this->idRepuestoAlmacen;


                        $repuestoAlmacenOrigen = RepuestoAlmacen::findOrFail($idRepuestoAlmacen);
                        $repuestoAlmacenOrigen->stock = $repuestoAlmacenOrigen->stock - $cantidad;
                        $repuestoAlmacenOrigen->update();







                        $idAlmacenDestino = $this->idAlmacenDestino;
                        $idAlmacenOrigen =  $this->idAlmacenOrigen;


                        $repuestoAlmacenDestino = $this->obtenerRepuestoAlmacen($idAlmacenDestino,$repuestoAlmacenOrigen->idRepuesto);

                        if (count($repuestoAlmacenDestino) > 0) {
                           $updateRepuestoAlmacen = RepuestoAlmacen::findOrFail($repuestoAlmacenDestino[0]->id);
                           $updateRepuestoAlmacen->stock = $updateRepuestoAlmacen->stock +  $cantidad;
                           $updateRepuestoAlmacen->update();
                           $this->emitir('success',"Se ha modificado");

                        }else{
                            $newRepuestoAlmacen = new RepuestoAlmacen();
                            $newRepuestoAlmacen->stock = $this->cantidad;
                            $newRepuestoAlmacen->idRepuesto = $repuestoAlmacenOrigen->idRepuesto;
                            $newRepuestoAlmacen->idAlmacen = $idAlmacenDestino;
                            $newRepuestoAlmacen->save();
                            $this->emitir('success',"Se ha creado");
                        }



                        $this->estadoInput = null;
                        $this->cantidad = null;
                        // $this->idAlmacenDestino = null;
                        // $this->idAlmacenOrigen = null;


                        $this->transferir = true;

                    }
                }

            }else{
                $this->emitir('danger',"Stock Insuficiente");
            }
        } else {
            $this->emitir('warning',"Digite una cantidad por favor");
        }

    }
    public function obtenerRepuestoAlmacen($idAlmacen,$idRepuesto){

        $repuestoAlmacenDestino = RepuestoAlmacen::
        where('repuesto_almacen.idRepuesto','=',$idRepuesto)
        ->where('repuesto_almacen.idAlmacen','=',$idAlmacen)->get();


        return $repuestoAlmacenDestino;
    }


}
