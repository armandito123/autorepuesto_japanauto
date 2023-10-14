<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repuesto;
use App\Models\RepuestoAlmacen;
use App\Models\MarcaModelo;
use App\Models\Precio;
use Illuminate\Support\Facades\Storage;
// use Picqer\Barcode\BarcodeGeneratorPNG as barcod;
use Picqer;
class RepuestoController extends Controller
{
    public function mostrar(Request $request){
        
        if ($request) {
            $query = trim($request->get('searchText'));
            $repuesto=Repuesto::select( 'repuestos.id',
            'repuestos.descripcion',
            'repuestos.codigo',
            'repuestos.imagen',
            'repuestos.precioVenta',
            
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
            ->orWhere('repuestos.descripcion','LIKE','%'.$query.'%')
            ->orWhere('marcas.nombre','LIKE','%'.$query.'%')
            ->orderBy('repuestos.id','asc')
            ->paginate(10);
        }else{
            $repuesto=Repuesto::select( 'repuestos.id',
            'repuestos.descripcion',
            'repuestos.imagen',
            'repuestos.codigo',
            'repuestos.precioVenta',
            
            'tipo_repuestos.tipo',
            'categorias.nombre as categoria',
            'marca_modelos.medida',
            'marca_modelos.submedida',
            'marca_modelos.idMarca',
            'marca_modelos.idModelo',
            'marca_modelos.id as idMarcaModelo'
            )
            ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
            ->join('categorias','categorias.id','=','repuestos.idCategoria')
            ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
            ->orderBy('repuestos.id','asc')
            ->paginate(10);
        }

        $marcasModelos = MarcaModelo::all();    
        return view('pages.repuesto.mostrar', [
            'repuestos'     => $repuesto,
            'marcasModelos' => $marcasModelos,
            'searchText'    => $query
        ]);
    }
    
 
    public function insertar(Request $request){
        // $label=$request->get('codigo');


        // $barcode_generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        // $barcode =$barcode_generator->getBarcode($label, $barcode_generator::TYPE_CODE_128);

        $repuesto                  = new Repuesto();
        $repuesto->codigo          = $request->get('codigo');
        $repuesto->descripcion     = $request->get('descripcion');
        $repuesto->precioVenta     = $request->get('precioVenta');
        $repuesto->precioCompra    = $request->get('precioCompra');

        if($request->file('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $repuesto->imagen = $path; 
        }else{
            $repuesto->imagen = 'imagenes/repuesto.png';
        }
        
        
        $repuesto->idCategoria     = $request->get('idCategoria');
        $repuesto->idMarcaModelo   = $request->idMarcaModelo;
        $repuesto->idTipoRepuesto   = $request->get('idTipoRepuesto');
        $repuesto->save();

        $fecha = date('Y-m-d');

        $precios = new Precio();
        $precios->precioVenta = $request->get('precioVenta');
        $precios->precioCompra = $request->get('precioCompra');
        $precios->fecha = $fecha;
        $precios->idRepuesto = $repuesto->id;
        $precios->save();
        return redirect('/repuesto/mostrar');

    }

    public function crear(){
        $marcaModelo= MarcaModelo::all();
        return view('pages.repuesto.crear',[
            'marcasModelos'=>$marcaModelo

        ]);
    }
    public function editar(Request $request){
        $marcaModelo= MarcaModelo::all();

        $repuesto = Repuesto::findOrFail($request->idRepuesto);
        return view('pages.repuesto.actualizar',[
            'marcasModelos'=>$marcaModelo,
            'repuesto' => $repuesto
        ]);
    }

    public function actualizar(Request $request){
        $repuesto                  = Repuesto::findOrFail($request->id);
        $repuesto->codigo          = $request->get('codigo');
        $repuesto->precioVenta     = $request->get('precioVenta');
        $repuesto->precioCompra    = $request->get('precioCompra');
        
        if($request->hasFile('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $repuesto->imagen = $path; 
        }
        if($request->get('descripcion')){
            $repuesto->descripcion     = $request->get('descripcion');
        }
        $repuesto->idCategoria     = $request->get('idCategoria');
        $repuesto->idMarcaModelo   = $request->idMarcaModelo;
        $repuesto->idTipoRepuesto   = $request->get('idTipoRepuesto');
        $repuesto->update();

        $fecha = date('Y-m-d');

        $precios = new Precio();
        $precios->precioVenta = $request->get('precioVenta');
        $precios->precioCompra = $request->get('precioCompra');
        $precios->fecha = $fecha;
        $precios->idRepuesto = $repuesto->id;
        $precios->save();


        return redirect('/repuesto/mostrar');
    }
   
    public function eliminar(Request $request){
        $repuesto             = Repuesto::findOrFail($request->id);
        $repuesto->delete();

        return redirect('/repuesto/mostrar');
    }



}
