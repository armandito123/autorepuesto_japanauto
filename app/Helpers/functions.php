<?php

use App\Http\Livewire\DetalleVenta;
use App\Models\Categoria;
use App\Models\Sucursal;
use App\Models\Marca;
use App\Models\MarcaModelo;
use App\Models\Modelo;
use App\Models\TipoRepuesto;
use App\Models\Repartidor;
use App\Models\Almacen;
use App\Models\Repuesto;
use App\Models\RepuestoAlmacen;
use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\DetalleCarrito;
use App\Models\DetalleNotaCarrito;
use App\Models\DetalleNotaPedido;
use App\Models\DetalleNotaVenta;
// use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Ubicacion;
use App\Models\User;
use App\Models\Venta;
use Symfony\Component\CssSelector\Node\FunctionNode;

//Configuracion del titulo
function titlePage(){
        $head = "JapanAuto";
    return $head;
}

// Datos de la empresa
function empresa($dato){
    $res='';
    if($dato =='nombre'){
        $res = 'AutorepuestoJapanAuto';
    }
    if ($dato =='direccion') {
        $res = 'Calle:Tarija #113, Montero';
    }
    if ($dato == 'telefono') {
        $res = '+591 78174627';
    }
    if ($dato =='email') {
        $res = 'japanautoEmp@gmail.com';
    }

    return $res;
}

// Datos del login

function login($dato){
    $res='';
    if($dato =='title'){
        $res = 'Iniciar Sesion';
    }
    if($dato =='placeholder-email'){
        $res = 'Email';
    }
    if($dato =='placeholder-password'){
        $res = '*************************';
    }
    if($dato =='registrar?'){
        $res = '¿Registrar un nuevo usuario?';
    }
    return $res;
}


//Configuracion Pie de Pagina Web
function footer($dato){
    $footer = null;
    $array = [
        "title"       => "JapanAuto",
        "typeCompany" => "Emp."
    ];
    if($dato == 'title'){
       $footer = $array["title"];
    }
    if($dato == 'typeCompany'){
        $footer = $array["typeCompany"];
    }
    return $footer;
}

function clientes(){
    $clientes = Cliente::all();
    return $clientes;
}

function cliente($idCliente){
    $clientes = Cliente::where('clientes.id','=',$idCliente)->get();
    return $clientes[0];
}

function nombreMarca($id){
    $marcaModelo= MarcaModelo::findOrFail($id);
    $idMaMo=$marcaModelo->idMarca;
    $marca= Marca::findOrFail($idMaMo);
    return $marca->nombre;
}

function nombreModelo($id){
    $marcaModelo= MarcaModelo::findOrFail($id);
    $idMaMo=$marcaModelo->idModelo;
    $modelo= Modelo::findOrFail($idMaMo);
    return $modelo->nombre;
}

function sucursales(){
    return  Sucursal::all();
}

function sucursales_diferentes_id($id){
    return  Sucursal::where('id','!=',$id)->get();
}

function categorias(){
    $categoria= Categoria::all();
    return $categoria;
}

function modelos(){
    $modelo= Modelo::all();
    return $modelo;
}

function tipos(){
    $tipo= TipoRepuesto::all();
    return $tipo;
}

function marcas(){
    $marca= Marca::all();
    return $marca;
}
function repartidores(){
    $repartidor= Repartidor::all();
    return $repartidor;
}
function repartidor($id){
    $repartidor = Repartidor::findOrFail($id);
    return $repartidor;
}

function marcaModelos(){
    $marcaModelo= MarcaModelo::all();
    return $marcaModelo;
}

function almacenes(){
    $almacen= Almacen::all();
    return $almacen;
}

function repuestos(){
    $repuestos= Repuesto::all();
    return $repuestos;
}

function transferirAlmacenes($idAlmacen){
    $almacenes = Almacen::where('id','!=',$idAlmacen)->get();
    return $almacenes;
}

function buscarRepuestoAlmacenStock($idAlmacen){
    $repuestos = RepuestoAlmacen::select('repuesto_almacen.id',
                'repuesto_almacen.stock',
                'repuestos.descripcion',
                'repuestos.imagen',
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
                    ->where('idAlmacen','=',$idAlmacen)
                    ->orderBy('repuesto_almacen.id', 'asc')
                    ->paginate(10);

    return $repuestos;
}

function repuesto($id){
    $repuestos = Repuesto::join('categorias','categorias.id','=','repuestos.idCategoria')
    ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
    ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
    ->join('marcas','marcas.id','=','marca_modelos.idMarca')
    ->join('modelos','modelos.id','=','marca_modelos.idModelo')

    ->select('categorias.nombre',
            'repuestos.descripcion',
            'repuestos.imagen',
            'repuestos.id',
            'repuestos.precioVenta',
            'categorias.nombre as categoria',
            'tipo_repuestos.tipo',
            'marca_modelos.medida',
            'marca_modelos.submedida',
            'marca_modelos.idMarca',
            'marca_modelos.idModelo',
            'marcas.nombre as marca',
            'modelos.nombre as modelo',
            'marca_modelos.id as idMarcaModelo'
            )
    ->where('repuestos.id','=',$id)->get();
    return $repuestos[0];
}

function categoria($id){
    $categorias = Categoria::
    where('categorias.id','=',$id)->get();
    return $categorias[0];

}


function tipo($id){
    $tipo = TipoRepuesto::
    where('tipo_repuestos.id','=',$id)->get();
    return $tipo[0];

}

function marcamodelo($idMarcaModelo){
    $marcaModelo = MarcaModelo::findOrFail($idMarcaModelo);
    return $marcaModelo;
}

function marca($id){
    $marca = Marca::findOrFail($id);
    return $marca;
}

function modelo($id){
    $modelo = Modelo::findOrFail($id);
    return $modelo;
}

function usuario($id){  //  <<<-----USUARIO
    $usuario = User::findOrFail($id);
    return $usuario;
}

function usuarios(){
    return  User::all();
}

function usuarios_diferentes_id($id){
    return  User::where('id','!=',$id)->get();
}


function repuestoCategoria($id){
    $repuestosCategoria =
    Repuesto::join('categorias','categorias.id','=','repuestos.idCategoria')->
    select('categorias.nombre as categoria')
    ->where('repuestos.id','=',$id)->get();
    return $repuestosCategoria[0];
}

function almacen($id){
    $almacen = Almacen::
    where('almacenes.id','=',$id)->get();
    return $almacen[0];
}


function repuestoTipo($idTipo){
    $repuesto = Repuesto::join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
    ->join('categorias','categorias.id','=','repuestos.idCategoria')
    ->select('tipo_repuestos.id as idTipo ',
             'tipo_repuestos.tipo',
            'categorias.nombre as categoria',
             'repuestos.id as idRepuesto ',
             'repuestos.descripcion as repuesto'
            )
    ->where('tipo_repuestos.id','=',$idTipo)->get();
    return $repuesto;
}

function selectRepuesto($idAlmacen){
    $repuestoAlmacen =RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
                                    ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
                                    ->select('almacenes.id as idAlmacen',
                                             'almacenes.sigla',
                                             'repuestos.id as idRepuesto',
                                             'repuestos.descripcion as repuesto',
                                             'repuesto_almacen.id as idRepuestoAlmacen'
                                    )
                                    ->where('repuesto_almacen.idAlmacen','=',$idAlmacen)->get();

    return $repuestoAlmacen;
}


    function buscarCliente($id){
        $cliente = Cliente::findOrFail($id);
        return $cliente;
    }

    function buscarRepartidor($id){
        $repartidor = Repartidor::findOrFail($id);
        return $repartidor;
    }

    function notaVenta($id){
        $notaVenta= Venta::findOrFail($id);
        return $notaVenta;
    }

    function detalleVenta($id){
        $detalleVenta= DetalleNotaVenta::where('detalle_venta.idNotaVenta','=',$id)->get();
        return $detalleVenta;

    }

    function detallePedidoCarritoCliente($idCliente){
        $carrito = Carrito::where('idCliente','=',$idCliente)->get();

        $detalleCarrito = DetalleNotaCarrito::
        join('repuestos','repuestos.id','=','detallecarrito.idRepuesto')
        ->where('idCarrito','=',$carrito[0]->id)->get();

        return $detalleCarrito;
    }


    function detallePedidoRepartidor($idPedido){
        $detallePedido = Pedido::join('detalle_pedido','detalle_pedido.idPedido','=','pedido.id')
        ->join('repuesto_almacen','repuesto_almacen.id','=','detalle_pedido.idRepuestoAlmacen')
        ->join('almacenes','almacenes.id','repuesto_almacen.idAlmacen')
        ->join('repuestos','repuestos.id','repuesto_almacen.idRepuesto')
        ->where('pedido.id','=',$idPedido)
        ->get();

        return $detallePedido;
    }

    function detallePedido($id){
        $detallePedido= DetalleNotaPedido::where('detalle_Pedido.idPedido','=',$id)->get();
        return $detallePedido;

    }

    function detalleCarrito($idPedido){
        $pedido = Pedido::findOrFail($idPedido);

        $car = Carrito::select(
         'detallecarrito.cantidad',
         'detallecarrito.submedida',
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
        ->join('clientes','clientes.id','=','carrito.idCliente')
        ->where('carrito.idCliente','=',$pedido->idCliente)
        // ->where('detallecarrito.estado','=',1)
        ->get();
        return $car;
    }


    function repuestoAlmacenSeleccionar($idRepuesto){
        $repuestoAlmacen = RepuestoAlmacen::where('idRepuesto','=',$idRepuesto)->get();
        return $repuestoAlmacen;
    }

    function operaciones($numero1,$numero2,$operacion){
        $result = 0;
        if ($operacion=='+') {
            $result = $numero1 + $numero2;
        }
        if ($operacion=='*') {
            $result = $numero1 * $numero2;
        }
        return $result;
    }

    function notaPedido($id){
        $notaPedido= Pedido::findOrFail($id);
        return $notaPedido;
    }
    function repuestoAlmacen($id){
        $repuestoAlmacen = RepuestoAlmacen::findOrFail($id);
        return $repuestoAlmacen;
    }
    function fechaHoy(){
      return $hoy = date('y-m-d');
    }
    function imagen($id){

    }
    function contarCarrito($id){
        $carrito = Carrito::where("idCliente","=",$id)->get();

        $detalle = DetalleCarrito::where("idCarrito","=",$carrito[0]->id)->get();
        $c = count($detalle);
        return $c;
    }
    function boolRuta($ruta){
        $sw = false;
        if (request()->is($ruta)) {
            $sw = true;
        }
        return $sw;
    }
    function ubicacion($idPedido){
        $pedido = Pedido::findOrFail($idPedido);
        $ubicacion = Ubicacion::findOrFail($pedido->idUbicacion);
        return $ubicacion;
    }
    function buscarrepuestoAlmacen($idRepuesto){
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
        return $repuestoAlmacen;
    }
    function pedido($id){
        $pedido  = Pedido::findOrFail($id);
        return $pedido;
    }

?>
