<?php

namespace App\Http\Livewire;

use App\Models\Almacen;
use App\Models\Repuesto;
use App\Models\RepuestoAlmacen;
use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

use function PHPUnit\Framework\isNull;

class AgregarInventarios extends Component{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $idRepuesto;
    public $idAlmacen = null;
    public $arrayRepuestos = [];
    public $index;
    public $criterio ;
    public $message;
    public $errorCodigo;
    public $errorExiste;


    public $searchCodigo;
    public $codigo;

    public $estado = "";

    public $idRepuestoSeleccionado;
    public $idAlmacenSeleccionado;

    public $cantidadSelect;
    public $precioCompraSelect;
    public $precioVentaSelect;

    public $cantidadModal;
    public $precioCompraModal;
    public $precioVentaModal;



    public $estadoCantidadPrecioModal = false;
    public $searchTextRepuestoModal = "";
    public $criterioModal = '';
// Almacen
    public $sigla;


    public $cantidad    ;

    public $stock  ;
    public $precioVenta  ;
    public $precioCompra ;


    public $vP = false;
    public $searchText;
    public $mensajeAlmacen = 'Seleccione un Almacen';
    public $final = false ;

    public function render(){
       $criterio  = $this->criterio;
        $searchText = '%'.$this->searchText.'%';
        $searchCodigo = $this->searchCodigo;


        $searchTextRepuestoModal = '%' . $this->searchTextRepuestoModal . '%';
        $criterioModal = $this->criterioModal;
        $this->estadosSeleccionados($criterioModal);
        $idAlmacen = $this->idAlmacen;

        $objRepuestoCodigo = $this->buscarRepuestoCodigo($searchCodigo);

        $objRepuesto = Almacen::criterioBusqueda($criterio,$searchText);
        $repuesto = $this->busquedaImplacable($criterioModal, $searchTextRepuestoModal);


        return view('livewire.almacen.agregar-inventarios',
            [
                'repuestos' => $repuesto,
                'repuestoSearch' => $objRepuestoCodigo,
            ]
        );
    }

    public function emitir($tipo, $message)
    {
        $data = [$tipo, $message];
        $this->emit('message', $data);
    }
    public function buscarRepuestoCodigo($searchCodigo)
    {
        $repuesto = RepuestoAlmacen::join('almacenes', 'almacenes.id', '=', 'repuesto_almacen.idAlmacen')
            ->join('repuestos', 'repuestos.id', '=', 'repuesto_almacen.idRepuesto')
            ->select('almacenes.id as idAlmacen',
                'almacenes.sigla',
                'repuestos.id as idRepuesto',
                'repuestos.descripcion as repuesto',
                'repuestos.precioVenta',
                'repuestos.imagen',
                'repuesto_almacen.id as idRepuestoAlmacen',
                'repuesto_almacen.stock',
            )
            ->where('codigo', '=', $searchCodigo)
            ->paginate(3);
        return $repuesto;
    }

    public function agrgadoRepuestoLista()
    {
        $idRepuesto = $this->idRepuesto;


        $repuesto = Repuesto::findOrFail($idRepuesto);

        if (is_null($this->precioVentaModal)) {
            $this->precioVentaModal = $repuesto->precioVenta;

        }
        if (is_null($this->precioCompraModal)) {
            $this->precioCompraModal = $repuesto->precioCompra;
        }
        if (is_null($this->cantidadModal)) {
            $this->cantidadModal = 1;
        }

        $cantidad = $this->cantidadModal;



        array_push($this->arrayRepuestos,[
            "idRepuestos"        => $this->idRepuesto,
            "codigo"            => $repuesto->codigo,
            "nombre"            => $repuesto->descripcion,
            "precioVenta"       => $this->precioVentaModal,
            "precioCompra"      => $this->precioCompraModal,
            "cantidad"          => $cantidad,
            "idAlmacen"         => $this->idAlmacen
        ]);
        $this->cantidadModal = null;
        $this->precioCompraModal = null;
        $this->precioVentaModal = null;

        $this->estadoCantidadPrecioModal = false;
        $this->emitir('success',"Agregado correctamente");

    }
    public function busquedaImplacable($criterio, $searchText)
    {

        $repuesto = Repuesto::
        select('repuestos.id as idRepuesto','descripcion','codigo','imagen')
            // join('almacenes', 'almacenes.id', '=', 'repuesto_almacen.idAlmacen')
            // ->join('repuestos', 'repuestos.id', '=', 'repuesto_almacen.idRepuesto')
            ->paginate(10);

        if ($criterio == 'repuestos') {
            $repuesto = Repuesto::
                select('repuestos.id as idRepuesto','descripcion','codigo','imagen')
                ->where('repuestos.descripcion', 'like', '%' . $searchText . '%')

                ->paginate(10);
        }
        if ($criterio == 'categorias') {
            $repuesto = Repuesto::
                select('repuestos.id as idRepuesto','descripcion','codigo','imagen')
                ->join('categorias', 'categorias.id', '=', 'repuestos.idCategoria')
                ->where('categorias.nombre', 'like', '%' . $searchText . '%')

                ->paginate(10);
        }
        if ($criterio == 'tipo_repuestos') {
            $repuesto = Repuesto::
                select('repuestos.id as idRepuesto','descripcion','codigo','imagen')
                ->join('tipo_Repuestos', 'tipo_Repuestos.id', '=', 'repuestos.idTipoRepuesto')
                ->where('tipo_repuestos.tipo', 'like', '%' . $searchText . '%')

                ->paginate(10);
        }
        if ($criterio == 'marcas') {
            $repuesto = Repuesto::
                select('repuestos.id as idRepuesto','descripcion','codigo','imagen')
                ->join('marca_modelos', 'marca_modelos.id', '=', 'repuestos.idMarcaModelo')
                ->join('marcas', 'marcas.id', '=', 'marca_modelos.idMarca')
                ->join('modelos', 'modelos.id', '=', 'marca_modelos.idModelo')
                ->where('marcas.nombre', 'like', '%' . $searchText . '%')
                ->paginate(10);
        }

        return $repuesto;

    }

    public function mount(){
        $this->errorExiste ='';
    }

    public function estadosSeleccionados($estado)
    {

        if ($estado != $this->estado) {
            $this->searchTextRepuestoModal = "";
            $this->estadoCantidadPrecioModal = false;
        }
        $this->estado = $estado;
    }

    public function resetError(){
        $this->errorExiste = '';
    }
    public function agregarRepuesto($idRepuesto){
        $this->idRepuestoSeleccionado = $idRepuesto;

        $this->idRepuesto = $idRepuesto;

        if (!$this->existe($this->idRepuesto)) {
            $this->estadoCantidadPrecioModal = true;
        }else{
            $this->emitir('danger', 'El repuesto ya fue asignado');
        }
    }
    public function agregarAlmacen($idAlmacen){
        $this->idAlmacen = $idAlmacen;
    }
    public function verProducto($idRepuesto){
        $this->vP = true;
        $this->idRepuesto = $idRepuesto;
    }
    public function verTablaProducto(){
        $this->vP = false;

    }
    public function existe($idRepuesto){
        $c = count($this->arrayRepuestos);
        $sw = false;

        for ($i=0; $i < $c; $i++) {
            if($this->arrayRepuestos[$i]['idRepuestos']==$idRepuesto && $this->idAlmacen == $this->arrayRepuestos[$i]['idAlmacen']){
                $sw = true;
            }
        }
        return $sw;
    }

    public function seleccionarRepuesto(){



        if($this->searchCodigo){

            $searchCodigo = $this->searchCodigo;
            $pieza = Repuesto::where('codigo','=',$searchCodigo)->get();

            $c = count($pieza);
            if ($c > 0){
                $this->idRepuesto = $pieza[0]->id;
                if (!$this->existe($this->idRepuesto)) {
                    $repuesto = Repuesto::findOrFail($this->idRepuesto);


                    if (is_null($this->precioCompraSelect)) {
                        $this->precioCompraSelect = $repuesto->precioCompra;
                    }
                    if (is_null($this->precioVentaSelect)) {
                        $this->precioVentaSelect = $repuesto->precioVenta;
                    }
                    if (is_null($this->cantidadSelect)) {
                        $this->cantidadSelect = 1;
                    }



                    array_push($this->arrayRepuestos,[
                        "idRepuestos"        => $repuesto->id,
                        "nombre"            => $repuesto->descripcion,
                        "codigo"            => $repuesto->codigo,
                        "precioVenta"       => $this->precioVentaSelect,
                        "precioCompra"      => $this->precioCompraSelect,
                        "cantidad"          => $this->cantidadSelect,
                        "idAlmacen"         => $this->idAlmacen
                    ]);

                    $this->cantidadSelect = null;
                    $this->precioCompraSelect = null;
                    $this->precioVentaSelect = null;

                    $this->emitir('success', "Agregado exitosamente");

                } else {
                    $this->emitir('danger', "El Repuesto ya fue seleccionado");
                }
            }else{
                $this->emitir('danger','El codigo no es valido');
            }
        }else{
            $this->emitir('danger','Ingrese un codigo');

        }

    }
    public function guardarInventario(){
        $c = count($this->arrayRepuestos);

        for ($i=0; $i < $c; $i++) {

            if ($this->existeRepuesto($this->arrayRepuestos[$i]['idRepuestos'],$this->arrayRepuestos[$i]['idAlmacen'])) {
                $idRepuestoAlmacen = $this->obtenerRepuestoAlmacen($this->arrayRepuestos[$i]['idRepuestos'],$this->arrayRepuestos[$i]['idAlmacen']);

                $objRepuestoAlmacen = RepuestoAlmacen::findOrFail($idRepuestoAlmacen);
                $objRepuestoAlmacen->stock = $objRepuestoAlmacen->stock + $this->arrayRepuestos[$i]['cantidad'];
                $objRepuestoAlmacen->update();

            }else{
                $repuestoAlmacen = new RepuestoAlmacen();
                $repuestoAlmacen->idRepuesto = $this->arrayRepuestos[$i]['idRepuestos'] ;
                $repuestoAlmacen->idAlmacen = $this->arrayRepuestos[$i]['idAlmacen'] ;
                $repuestoAlmacen->stock     = $this->arrayRepuestos[$i]['cantidad'] ;
                $repuestoAlmacen->save();
            }
        }
        $this->final = true;
    }
    public function existeRepuesto($idRepuesto,$idAlmacen){
        $sw = 0;
        $existe = RepuestoAlmacen::where('idAlmacen','=',$idAlmacen)
                                 ->where('idRepuesto','=',$idRepuesto)
                                 ->get();
        if (count($existe)) {
            $sw = 1;
        }
        return $sw;
    }
    public function obtenerRepuestoAlmacen($idRepuesto,$idAlmacen){
        $repuestoAlmacen = RepuestoAlmacen::where('idAlmacen','=',$idAlmacen)
        ->where('idRepuesto','=',$idRepuesto)
        ->get();

        return $repuestoAlmacen[0]->id;
    }
    public function crearAlmacen(){

        $almacen = new Almacen();
        $almacen->sigla = $this->sigla;
        $almacen->save();
    }

    public function actualizarPrecioStock($i){


        if (!is_null($this->cantidad)) {

            $this->arrayRepuestos[$i]['cantidad'] = $this->cantidad;
            $this->emitir('success','la cantidad se ha actualizado correctamente');

        }
        if (!is_null($this->precioVenta)) {

            $this->arrayRepuestos[$i]['precioVenta'] = $this->precioVenta;
            $this->emitir('success','Precio de venta actualizado correctamente');

        }
        if (!is_null($this->precioCompra)) {

            $this->arrayRepuestos[$i]['precioCompra'] = $this->precioCompra;
            $this->emitir('success','Precio de compra actualizado correctamente');

        }

        $this->cantidad   = null;
        $this->precioVenta = null;
        $this->precioCompra = null;
    }
    public function eliminarRepuesto($index){
        array_splice($this->arrayRepuestos,$index,1);
        $this->emitir('danger','Eliminado correctamente');
    }

}
