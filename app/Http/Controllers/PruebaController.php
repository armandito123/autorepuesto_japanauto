<?php

namespace App\Http\Controllers;

use App\Http\Livewire\DetallePedido;
use App\Models\Repuesto;
use App\Models\RepuestoAlmacen;
use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\DetalleCarrito;
use App\Models\DetalleNotaCarrito;
use App\Models\DetalleNotaPedido;
use App\Models\MarcaModelo;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PruebaController extends Controller
{

    public function clases(){
        return view('pages.prueba.index');
    }

    public function buscar(){

        $c = RepuestoAlmacen::select('repuesto_almacen.id',
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
                // ->where('repuestos.descripcion','LIKE','%'.$searchText.'%')
                    // ->orWhere('almacenes.sigla', 'LIKE', '%' . $searchText . '%')
                    ->where('idAlmacen','=',1)
                    ->orderBy('repuesto_almacen.id', 'asc')
                    ->paginate(10);

        return $c;

        $idAlmacen = 1;
        $repuestos = RepuestoAlmacen::
        select('repuesto_almacen.id',
                'repuesto_almacen.stock',
                'repuesto_almacen.idRepuesto',
                'repuesto_almacen.idAlmacen',
                'repuestos.descripcion',
                'repuestos.imagen',
                'repuestos.precioVenta',
                'repuestos.idCategoria',
                'repuestos.idTipoRepuesto',
                'repuestos.idMarcaModelo',
        )
        ->join('almacenes','almacenes.id','=','repuesto_almacen.idRepuesto')
        ->join('repuestos','repuestos.id','=','repuesto_almacen.idAlmacen')
        ->where('repuesto_almacen.idAlmacen','=',$idAlmacen)
        ->get();


        return $repuestos;



        return $repuestos;
        $pedido = Pedido::findOrFail(2);

        return $pedido;



        $car = Carrito::select(
         'detallecarrito.cantidad',
         'detallecarrito.medida',
         'detallecarrito.estado',
         'detallecarrito.idCarrito',
         'detallecarrito.idRepuesto',
         'repuestos.descripcion',
         'repuestos.imagen',
         'repuestos.precioVenta'

        )
        ->join('detallecarrito','detallecarrito.idCarrito','=','carrito.id')
        ->join('repuestos','repuestos.id','=','detallecarrito.idRepuesto')
        ->where('carrito.idCliente','=',$pedido->idCliente)
        ->get();


        return $car;


        $idRepuesto = 30;
        $repuesto  = Repuesto::findOrFail($idRepuesto);

        $marcaModelo  = MarcaModelo::join('repuestos','repuestos.idMarcaModelo','=','marca_modelos.id')
        ->where('repuestos.id','=',$repuesto->id)->get();




        $repuestoAlmacen  = RepuestoAlmacen::join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
        ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        ->join('categorias','categorias.id','=','repuestos.idCategoria')
        ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
        // ->select('repuestos.id as idRepuesto',
        //          'marca_modelos.id as idMarcaModelo',
        //          'repuesto_almacen.id as idRepuestoAlmacen'
        // )
        ->where('categorias.id','=',$repuesto->idCategoria)
        ->where('tipo_repuestos.id','=',$repuesto->idTipoRepuesto)
        ->where('marca_modelos.idMarca','=',$marcaModelo[0]->idMarca)
        ->where('repuestos.descripcion','LIKE','%'.$repuesto->descripcion.'%')->get();

        // $idPedido=12;
        // $pedido = Pedido::findOrFail($idPedido);

        // $carrito = Carrito::where('idCliente','=',$pedido->idCliente)->get();
        // $idCarrito = $carrito[0]->id;

        // $detalleCarrito= DetalleNotaCarrito::
        // where('detallecarrito.idCarrito','=',$idCarrito)
        // ->where('detallecarrito.estado','=',1)
        // ->get();

        // return $detalleCarrito;


        return $repuestoAlmacen;
        // $detallePedido= DetalleNotaPedido::where('detalle_Pedido.idPedido','=',11)->get();
        // return $detallePedido;



        $pedido = Pedido::
        // join('repartidores','repartidores.id','=','pedido.idRepartidor')
            join('clientes','clientes.id','=','pedido.idCliente')
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
            // ->where('clientes.nombre','LIKE','%'.$searchText.'%')
            ->paginate(10);
            return $pedido;

        // $idRepuestoAlmacen =
        // RepuestoAlmacen::select('repuesto_almacen.id as idRepuestoAlmacen')->
        // join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
        // ->join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
        // ->where('idAlmacen','=',2)
        // ->where('idRepuesto','=',66)
        // ->get();
        // return $idRepuestoAlmacen[0];

    //     $horaA=date('H:i:s');

    //     $tiempo= "23:12:59";

    //     $hA= date('H');
    //     $iA=date('i');
    //     $sA=date('s');



    // // obtengo segundos
    //     $substrsegundo= substr($tiempo,6);
    //     $st= $substrsegundo;
    // // minutos
    //     $substr= substr($tiempo,3);
    //     $it=substr($substr,0,2);

    // //hora
    //     $ht= substr($tiempo,0,2);


    //     $ss = $sA + $st;
    //     $si = $iA + $it;
    //     $sh = $hA + $ht;
    //     // suma segundo con condicion
    //     if ($ss > 60) {
    //         $rss=$ss-60;
    //         $ss=$rss;

    //         $si=$si + 1;
    //     }

    //     if ($ss == 60) {
    //         $ss="00";

    //         $si=$si + 1;
    //     }

    //     // suma minuto con condicion

    //     if ($si > 60) {
    //         $rss=$si-60;
    //         $si=$rss;

    //         $sh=$sh + 1;
    //     }

    //     if ($si == 60) {
    //         $si="00";

    //         $sh=$sh + 1;
    //     }

    //     //suma hora con condicion

    //     if ($sh > 24) {
    //         $rss=$sh-24;
    //         $sh=$rss;

    //         // $si=$si + 1;
    //     }

    //     if ($sh == 24) {
    //         $sh="00";

    //         // $si=$si + 1;
    //     }

    //     if ($ss <10) {
    //         $ss="0".$ss;
    //     }

    //     if ($si <10) {
    //         $si="0".$si;
    //     }

    //     if ($sh <10) {
    //         $sh="0".$sh;
    //     }

    //     return $sh.':'.$si.':'.$ss;

    //     return [
    //         'hora'=>$ht,
    //         'minuto'=>$it,
    //         'segundo'=> $st,

    //         'horaActual'=>$hA,
    //         'minutoActual'=>$iA,
    //         'segubdoActual'=>$sA,

    //         'sumasegundo' =>$ss,
    //         'sumaminuto' =>$si,
    //         'sumahora' =>$sh
    //     ];






        // $obj = Carrito::Where('idCliente','=',3)
        // ->get();

        // $detallecarrito =DetalleCarrito::where('idCarrito','=',$obj[0]->id)
        // ->get();

        // $array=[];
        // foreach ($detallecarrito as $key => $value) {
        //     array_push($array,$value->id);
        // }

        // return $array;

        // $carrito = Carrito::join('clientes','clientes.id','carrito.idCliente')
        // ->join('detallecarrito','detallecarrito.idCarrito','carrito.id')
        // ->where("clientes.id","=",3)
        // ->get();

        // return $carrito;

        // $c = Carrito::where("idCliente","=",3)->get();
        // return $c[0]->id;
        // $criterio = "marcas";
        // $atributo = "";
        // $idTipo = 1;
        // $searchText = "sjhkjhsk";
        // if($criterio=='categorias'){$atributo = 'nombre';}
        // if($criterio=='marcas'){$atributo = 'nombre';}
        // if($criterio=='repuestos'){$atributo = 'descripcion';}



        // $attr = $this->atributo;

        // $repuesto = Repuesto::select(
        //     "repuestos.id as idRepuesto",
        //     "repuestos.descripcion",
        //     "repuestos.precioVenta as precio",
        //     "repuestos.imagen as img",
        //     "repuestos.idMarcaModelo",
        //     "tipo_repuestos.tipo",
        //     "categorias.nombre as categoria",
        //     "marcas.nombre as marca",
        //     "marcas.id as idMarca",
        //     "categorias.id as idCategoria",
        // )->
        // join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        // ->join('categorias','categorias.id','=','repuestos.idCategoria')
        // ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
        // ->join('marcas','marcas.id','=','marca_modelos.idMarca')
        // ->where('tipo_repuestos.id','=',$idTipo)
        // ->where($criterio.'.'.$atributo,'LIKE','%'.$searchText.'%')
        // ->get();

        // if($repuesto){
        //     $repuesto = Repuesto::select(
        //         "repuestos.id as idRepuesto",
        //         "repuestos.descripcion",
        //         "repuestos.precioVenta as precio",
        //         "repuestos.imagen as img",
        //         "repuestos.idMarcaModelo",
        //         "tipo_repuestos.tipo",
        //         "categorias.nombre as categoria",
        //         "marcas.nombre as marca",
        //         "marcas.id as idMarca",
        //         "categorias.id as idCategoria",
        //     )->
        //     join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        //     ->join('categorias','categorias.id','=','repuestos.idCategoria')
        //     ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
        //     ->join('marcas','marcas.id','=','marca_modelos.idMarca')
        //     ->where('tipo_repuestos.id','=',$idTipo)
        //     ->get();
        // }


        // return $repuesto;

        // $repuesto = Repuesto::
        // join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')->where('tipo_repuestos.id','=',1)->get();
        // // $criterio = 'categorias';

        // return $repuesto;


        // $searchCodigo = "Manaco";
        // $idAlamcen = 1;
        // $criterio = 'marcas';

        // if($criterio == 'repuestos'){

        //     $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
        //     ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
        //     ->join('categorias','categorias.id','=','repuestos.idCategoria')

        //     ->select('categorias.nombre as categoria',
        //             'repuestos.id as idRepuesto',
        //             'repuestos.descripcion',
        //             'repuestos.imagen',
        //             'repuestos.codigo',
        //             'repuestos.precioVenta',
        //             'repuestos.precioCompra',
        //             'almacenes.id as idAlmacen',
        //             'almacenes.sigla',
        //             'repuesto_almacen.id as idRepuestoAlmacen',
        //             )
        //     ->where($criterio.'.descripcion','LIKE','%'.$searchCodigo.'%')
        //     ->where('almacenes.id','=',$idAlamcen)
        //     ->orWhere($criterio.'.codigo','=',$searchCodigo)
        //     ->paginate(1);
        //     return $repuesto;
        // }
        // if($criterio == 'categorias'){
        //     $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
        //     ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
        //     ->join('categorias','categorias.id','=','repuestos.idCategoria')

        //     ->select('categorias.nombre as categoria',
        //             'repuestos.id as idRepuesto',
        //             'repuestos.descripcion',
        //             'repuestos.imagen',
        //             'repuestos.codigo',
        //             'repuestos.precioVenta',
        //             'repuestos.precioCompra',
        //             'almacenes.id as idAlmacen',
        //             'almacenes.sigla',
        //             'repuesto_almacen.id as idRepuestoAlmacen',
        //             )
        //     ->where('almacenes.id','=',$idAlamcen)
        //     ->where($criterio.'.nombre','LIKE','%'.$searchCodigo.'%')
        //     ->paginate(1);
        //     return $repuesto;
        // }
        // if($criterio == 'tipo_repuestos'){
        //     $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
        //     ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
        //     ->join('categorias','categorias.id','=','repuestos.idCategoria')
        //     ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        //     ->select('categorias.nombre as categoria',
        //             'repuestos.id as idRepuesto',
        //             'repuestos.descripcion',
        //             'repuestos.imagen',
        //             'repuestos.codigo',
        //             'repuestos.precioVenta',
        //             'repuestos.precioCompra',
        //             'almacenes.id as idAlmacen',
        //             'almacenes.sigla',
        //             'repuesto_almacen.id as idRepuestoAlmacen',
        //             'tipo_repuestos.tipo as tipo',
        //             )
        //     ->where('almacenes.id','=',$idAlamcen)
        //     ->where($criterio.'.tipo','LIKE','%'.$searchCodigo.'%')
        //     ->paginate(1);
        //     return $repuesto;
        // }

        // if($criterio == 'marcas'){
        //     $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
        //     ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
        //     ->join('categorias','categorias.id','=','repuestos.idCategoria')
        //     ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        //     ->join('marca_modelos','marca_modelos.id','repuestos.idMarcaModelo')
        //     ->join('marcas','marcas.id','=','marca_modelos.idMarca')
        //     ->select('categorias.nombre as categoria',
        //             'repuestos.id as idRepuesto',
        //             'repuestos.descripcion',
        //             'repuestos.imagen',
        //             'repuestos.codigo',
        //             'repuestos.precioVenta',
        //             'repuestos.precioCompra',
        //             'almacenes.id as idAlmacen',
        //             'almacenes.sigla',
        //             'repuesto_almacen.id as idRepuestoAlmacen',
        //             'tipo_repuestos.tipo as tipo',
        //             )
        //     ->where('almacenes.id','=',$idAlamcen)
        //     ->where($criterio.'.nombre','LIKE','%'.$searchCodigo.'%')
        //     ->paginate(1);
        //     return $repuesto;
        // }
        // $sw = 0;
        // $existe = RepuestoAlmacen::where('idAlmacen','=',1)
        //                          ->where('idRepuesto','=',1)
        //                          ->get();
        // if (count($existe)) {
        //     $sw = 1;
        // }
        // return $sw;

        // $repuestoAlmacen = RepuestoAlmacen::where('idAlmacen','=',1)
        // ->where('idRepuesto','=',1)
        // ->get();



        // return $repuestoAlmacen[0]->id;





    }
    public function existeRepuesto($idRepuesto,$idAlmacen){
        $sw = false;
        $existe = RepuestoAlmacen::where('idAlmacen','=',$idAlmacen)
                                 ->where('idCalazado','=',$idRepuesto)
                                 ->get();
        if (count($existe)) {
            $sw = true;
        }
        return $sw;
    }
}
