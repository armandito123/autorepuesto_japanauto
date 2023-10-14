<?php

use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\RepuestoAlmacenController;
use App\Http\Controllers\RepuestoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContactoController;//Contacto Cliente
use App\Http\Controllers\ContactoAdminController;//Contacto Administrador
use App\Http\Controllers\ContactoRepartidorController;//Contacto Repartidor
use App\Http\Controllers\LoginServer;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\MarcaModeloController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\RegisterServer;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\TipoRepuestoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/', [WebController::class, 'inicio']);

Route::get('/showLogin', [LoginServer::class, '__invoke'])->name('showLogin');
Route::get('/showRegister', [RegisterServer::class, '__invoke'])->name('showRegister');

Route::middleware(['auth'])->group(function () {

    [Route::get('/dasboard', function () {return view('index');})];

// --------USUARIOS----------
    Route::get('/usuario/mostrar', [UsuarioController::class, 'mostrar'])->name('usuario.index');
    Route::get('/usuario/crear', [UsuarioController::class, 'crear'])->name('usuario.crear');
    Route::post('/usuario/insertar', [UsuarioController::class, 'insertar'])->name('usuario.store');
    Route::post('/usuario/actualizar', [UsuarioController::class, 'actualizar'])->name('usuario.update');
    Route::post('/usuario/eliminar', [UsuarioController::class, 'eliminar'])->name('usuario.delete');

    // --------MODELO-------
    Route::get('/modelo/mostrar', [ModeloController::class, 'mostrar'])->name('modelo.index');
    Route::post('/modelo/insertar', [ModeloController::class, 'insertar'])->name('modelo.store');
    Route::post('/modelo/actualizar', [ModeloController::class, 'actualizar'])->name('modelo.update');
    Route::post('/modelo/eliminar', [ModeloController::class, 'eliminar'])->name('modelo.delete');

    // persona.update
//  -------CATEGORIA-------
    Route::get('/categoria/mostrar', [CategoriaController::class, 'mostrar'])->name('categoria.index');
    Route::post('/categoria/insertar', [CategoriaController::class, 'insertar'])->name('categoria.store');
    Route::post('/categoria/actualizar', [CategoriaController::class, 'actualizar'])->name('categoria.update');
    Route::post('/categoria/eliminar', [CategoriaController::class, 'eliminar'])->name('categoria.delete');

    // --------MARCA----------
    Route::get('/marca/mostrar', [MarcaController::class, 'mostrar'])->name('marca.index');
    Route::post('/marca/insertar', [MarcaController::class, 'insertar'])->name('marca.store');
    Route::post('/marca/actualizar', [MarcaController::class, 'actualizar'])->name('marca.update');
    Route::post('/marca/eliminar', [MarcaController::class, 'eliminar'])->name('marca.delete');

// --------CLIENTE----------
    Route::get('/cliente/mostrar', [ClienteController::class, 'mostrar'])->name('cliente.index');
    Route::post('/cliente/insertar', [ClienteController::class, 'insertar'])->name('cliente.store');
    Route::post('/cliente/actualizar', [ClienteController::class, 'actualizar'])->name('cliente.update');
    Route::post('/cliente/eliminar', [ClienteController::class, 'eliminar'])->name('cliente.delete');

// --------PROVEEDOR----------
    Route::get('/proveedor/mostrar', [ProveedorController::class, 'mostrar'])->name('proveedor.index');
    Route::post('/proveedor/insertar', [ProveedorController::class, 'insertar'])->name('proveedor.store');
    Route::post('/proveedor/actualizar', [ProveedorController::class, 'actualizar'])->name('proveedor.update');
    Route::post('/proveedor/eliminar', [ProveedorController::class, 'eliminar'])->name('proveedor.delete');

// --------REPARTIDOR----------
    Route::get('/repartidor/mostrar', [RepartidorController::class, 'mostrar'])->name('repartidor.index');
    Route::post('/repartidor/insertar', [RepartidorController::class, 'insertar'])->name('repartidor.store');
    Route::post('/repartidor/actualizar', [RepartidorController::class, 'actualizar'])->name('repartidor.update');
    Route::post('/repartidor/eliminar', [RepartidorController::class, 'eliminar'])->name('repartidor.delete');

// --------TIPO REPUESTO----------
    Route::get('/tipoRepuesto/mostrar', [TipoRepuestoController::class, 'mostrar'])->name('tipoRepuesto.index');
    Route::post('/tipoRepuesto/insertar', [TipoRepuestoController::class, 'insertar'])->name('tipoRepuesto.store');
    Route::post('/tipoRepuesto/actualizar', [TipoRepuestoController::class, 'actualizar'])->name('tipoRepuesto.update');
    Route::post('/tipoRepuesto/eliminar', [TipoRepuestoController::class, 'eliminar'])->name('tipoRepuesto.delete');

// ---------VEHICULO----------
    Route::get('/vehiculo/mostrar', [VehiculoController::class, 'mostrar'])->name('vehiculo.index');
    Route::post('/vehiculo/insertar', [VehiculoController::class, 'insertar'])->name('vehiculo.store');
    Route::post('/vehiculo/actualizar', [VehiculoController::class, 'actualizar'])->name('vehiculo.update');
    Route::post('/vehiculo/eliminar', [VehiculoController::class, 'eliminar'])->name('vehiculo.delete');

// --------MARCA MODELO----------
    Route::get('/marcaModelo/mostrar', [MarcaModeloController::class, 'mostrar'])->name('marcaModelo.index');
    Route::get('/marcaModelo/crear', [MarcaModeloController::class, 'crear'])->name('marcaModelo.crear');
    Route::post('/marcaModelo/insertar', [MarcaModeloController::class, 'insertar'])->name('marcaModelo.store');
    Route::post('/marcaModelo/actualizar', [MarcaModeloController::class, 'actualizar'])->name('marcaModelo.update');
    Route::post('/marcaModelo/eliminar', [MarcaModeloController::class, 'eliminar'])->name('marcaModelo.delete');

// --------ALMACEN----------
    Route::get('/almacen/mostrar', [AlmacenController::class, 'mostrar'])->name('almacen.index');
    Route::get('/almacen/crear', [AlmacenController::class, 'crear'])->name('almacen.crear');
    Route::post('/almacen/insertar', [AlmacenController::class, 'insertar'])->name('almacen.store');
    Route::post('/almacen/actualizar', [AlmacenController::class, 'actualizar'])->name('almacen.update');
    Route::post('/almacen/eliminar', [AlmacenController::class, 'eliminar'])->name('almacen.delete');

// --------SUCURSAL----------
Route::get('/sucursal/mostrar', [SucursalController::class, 'mostrar'])->name('sucursal.index');
Route::post('/sucursal/insertar', [SucursalController::class, 'insertar'])->name('sucursal.store');
Route::post('/sucursal/actualizar', [SucursalController::class, 'actualizar'])->name('sucursal.update');
Route::post('/sucursal/eliminar', [SucursalController::class, 'eliminar'])->name('sucursal.delete');

// --------REPUESTOS----------
    Route::get('/repuesto/mostrar', [RepuestoController::class, 'mostrar'])->name('repuesto.index');
    Route::get('/repuesto/crear', [RepuestoController::class, 'crear'])->name('repuesto.crear');
    Route::get('/repuesto/editar', [RepuestoController::class, 'editar'])->name('repuesto.edit');
    Route::post('/repuesto/insertar', [RepuestoController::class, 'insertar'])->name('repuesto.store');
    Route::post('/repuesto/actualizar', [RepuestoController::class, 'actualizar'])->name('repuesto.update');
    Route::post('/repuesto/eliminar', [RepuestoController::class, 'eliminar'])->name('repuesto.delete');

// REPUESTO ALMACEN
    Route::get('/repuestoAlmacen/mostrar', [RepuestoAlmacenController::class, 'mostrar'])->name('repuestoAlmacen.index');
    Route::get('/repuestoAlmacen/crear', [RepuestoAlmacenController::class, 'crear'])->name('repuestoAlmacen.create');
    Route::get('/repuestoAlmacen/transferir', [RepuestoAlmacenController::class, 'transferir'])->name('repuestoAlmacen.transaferir');

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// VENTAS
Route::get('/venta/mostrar', [App\Http\Controllers\VentaController::class, 'mostrar'])->name('venta.index');
Route::get('/venta/crear', [App\Http\Controllers\VentaController::class, 'crear'])->name('venta.create');

Route::get('/prueba', [App\Http\Controllers\PruebaController::class, 'prueba']);

Route::get('/prueba', [PruebaController::class, 'buscar']);
Route::get('/categoria/buscar', [CategoriaController::class, 'buscar']);

// DELIVERY
Route::get('/delivery/mostrar', [PedidoController::class, 'mostrar'])->name('delivery.index');
Route::get('/delivery/crear', [PedidoController::class, 'crear'])->name('delivery.create');


Route::get('/bitacora', [UsuarioController::class,'bitacora']);



});

Auth::routes();


// WEB-----
// /web/repuesto
Route::get('/web/repuesto', [WebController::class, 'repuestos'])->name('web.repuesto');
Route::get('/web/marca', [WebController::class, 'buscarMarcas'])->name('web.marca');
Route::get('/web/buscarRepuesto', [WebController::class, 'buscarRepuesto'])->name('web.buscarRepuesto');
Route::get('/web/marca/{id}', [UsuarioController::class, 'marcaDetalle'])->name('marca.detalle');
Route::post('/guardar/pedido', [WebController::class, 'guardarPedido'])->name('guardar.store');

Route::get('/web/Marcas', [WebController::class, 'marcas'])->name('web.marcas');
Route::get('/web/Tipos', [WebController::class, 'tipos'])->name('web.tipos');
Route::get('/web/Categorias', [WebController::class, 'categorias'])->name('web.categorias');

Route::get('/web/detalleRepuesto', [WebController::class, 'detalleRepuesto'])->name('web.detalle');

// PEDIDO
Route::get('/cliente/pedido', [PedidoController::class, 'clientePedido'])->name('cliente.pedido');

// REPARTIDORPEDIDOR
Route::get('/repartidor/pedido', [PedidoController::class, 'repartidorPedido'])->name('repartidor.pedido');

//  PAGOS
Route::get('/pagos', [WebController::class, 'hacerPagos'])->name('web.pago');

//confirmar pedido

Route::post('/confirmar', [PedidoController::class, 'confirmarPedido'])->name('confirmar');

// Route::get('/pdf/orden/{id}','ctrlPDF@generarPDFOrden')->name('orden.pdf');
// Route::get('/pdf/pedido/{id}','ctrlPDF@generarPDFPedido')->name('pedido.pdf');
Route::get('/pdfCompras', [PdfController::class, 'generarPDFCompra'])->name('pdf.compras');
Route::get('/pdfVentas', [PdfController::class, 'generarPDFVenta'])->name('pdf.ventas');
Route::get('/pdfPedidos', [PdfController::class, 'generarPDFPedido'])->name('pdf.pedidos');


//Enviar Correos
// Route::get('/contacto', 'ContactController@showForm');
// Route::post('/contacto', 'ContactController@sendEmail');
// Route::get('/contacto',[ContactController::class, 'showForm'])->name('contacto');
// Route::post('/contacto',[ContactController::class, 'sendEmail'])->name('contacto');

//Redirecciona directamente a la ruta contacto
Route::get('/contacto', function() {
    return redirect('contacto');
});

//Ruta Contacto Cliente
Route::get('contacto',[ContactoController::class, 'index'])->name('contacto.index');
Route::post('contacto',[ContactoController::class, 'store'])->name('contacto.store');
//Ruta Contacto Administrador
Route::get('/contactoadmin/mostrar', [ContactoAdminController::class, 'index'])->name('contactoadministrador.index');
Route::post('contactoadmin/mostrar',[ContactoAdminController::class, 'store'])->name('contactoadministrador.store');
//Ruta Contacto Repartidor
Route::get('/contactorepartidor/mostrar', [ContactoRepartidorController::class, 'index'])->name('contactorepartidor.index');
Route::post('contactorepartidor/mostrar',[ContactoRepartidorController::class, 'store'])->name('contactorepartidor.store');

