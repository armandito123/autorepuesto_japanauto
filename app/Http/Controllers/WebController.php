<?php

namespace App\Http\Controllers;

use App\Models\Repuesto;
use App\Models\Categoria;
use App\Models\DetallePedido;
use App\Models\Marca;
use App\Models\Pedido;
use App\Models\TipoRepuesto;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function inicio(){
            
            return view('layouts.pages.inicio');   
    }
    public function repuestos($id){
        return view('layouts.pages.detalleRepuesto');    
    }
    public function marcaDetalle($id){
        return "Marca modelo " +  $id;
    }
    public function buscarMarcas(Request $request){
        $marca =Repuesto::select( 'repuestos.id',
        'repuestos.descripcion',
        'repuestos.imagen',

        'repuestos.precioVenta',
        'repuestos.precioCompra',
        'tipo_repuestos.tipo',
        'categorias.nombre as categoria',
        'marca_modelos.medida',
        'marca_modelos.submedida',
        'marca_modelos.idMarca',
        'marca_modelos.idModelo',
        'marca_modelos.id as idMarcaModelo',
        'marcas.nombre as marca'
        )
        ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        ->join('categorias','categorias.id','=','repuestos.idCategoria')
        ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
        ->join('marcas','marcas.id','=','marca_modelos.idMarca')
        ->where('marcas.id','=',$request->id)->get();
        return [
            'marca' => $marca
        ];
    }

    public function buscarRepuesto(Request $request){
        $repuesto =Repuesto::select( 'repuestos.id',
        'repuestos.descripcion',
        'repuestos.imagen',

        'repuestos.precioVenta',
        'repuestos.precioCompra',
        'tipo_repuestos.tipo',
        'categorias.nombre as categoria',
        'marca_modelos.medida',
        'marca_modelos.submedida',
        'marca_modelos.idMarca',
        'marca_modelos.idModelo',
        'marca_modelos.id as idMarcaModelo',
        'marcas.nombre as marca'
        )
        ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        ->join('categorias','categorias.id','=','repuestos.idCategoria')
        ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
        ->join('marcas','marcas.id','=','marca_modelos.idMarca')
        ->where('repuestos.id','=',$request->id)->get();
        return [
            'repuesto' => $repuesto
        ];
    }
    public function sumarHoras($hora1,$hora2){
        $arrayHoras  = array($hora1, $hora2);

        
    }

    public function guardarPedido(Request $request){
        
        
        $arrayRepuesto  = $request->arrayRepuesto;
        $arrayCantidad = $request->arrayCantidad;
        $arraySubTotal = $request->arraySubTotal;
        $arrayMedida    = $request->arrayMedida;
        $arraySubMedida    = $request->arraySubMedida;
        
        
        
        $id = auth()->id();

        $ubicacion = new Ubicacion();
        $ubicacion->latitud = $request->latitud;
        $ubicacion->longitud = $request->longitud;
        $ubicacion->referencia = $request->referencia;
        $ubicacion->url = $request->link;
        $ubicacion->save();


        $pedido = new Pedido();
        $pedido->estado = 0;
        $pedido->fecha = date('y-m-d');
        $pedido->fechaentrega = date('y-m-d');
        $pedido->hora = date('H:s:i');
        $pedido->horaentrega = date('H:s:i');
        $pedido->tiempoentrega = $request->tiempo;
        $pedido->montototal = $request->total;
        $pedido->idUser = Auth::id();
        $pedido->idRepartidor = null;
        $pedido->idCliente = Auth::id();
        $pedido->idUbicacion = $ubicacion->id;
        $pedido->save();
        
        for ($i=0; $i < $request->c; $i++) { 
            $detallePedido = new DetallePedido();
            $detallePedido->cantidad = $arrayCantidad[$i];
            $detallePedido->subTotal = $arraySubTotal[$i];
            $detallePedido->idPedido = $pedido->id;
            $detallePedido->idRepuestoAlmacen = null;
            $detallePedido->save();
        }
    }


    public function marcas(Request $request){
        $marca = Marca::findOrFail($request->id);
        return view('layouts.pages.marca.marcas',[
            "marca" => $marca
        ]);
    }
    public function tipos(Request $request){
        $tipo = TipoRepuesto::findOrFail($request->id);
        return view('layouts.pages.tipo.tipos',[    
            "tipo" => $tipo 
        ]);

    }
    public function categorias(Request $request){
        $categoria = Categoria::findOrFail($request->id);
        
        return view('layouts.pages.categoria.categorias',[
            "categoria" => $categoria
        ]);

    }


    
    // Detalle Marcas
    public function detalleRepuesto(Request $request){
        
        $repuesto = Repuesto::findOrFail($request->id);
        return view('layouts.pages.marca.detalleRepuesto',[
            'repuesto'=> $repuesto
        ]);
    }

    public function hacerPagos(Request $request){
        

        return view('layouts.pages.pago.pagos',[
            "idCliente" => $request->id
        ]);
    }
}
