<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepuestoAlmacen;


class RepuestoAlmacenController extends Controller
{
    public function mostrar(Request $request){

        if ($request) {
        $query = trim($request->get('searchText'));
        $repuestoAlmacen=RepuestoAlmacen::select('repuesto_almacen.id',
                                                 'repuesto_almacen.stock',
                                                 'repuestos.descripcion as repuesto',        
                                                 'categorias.nombre as categoria',
                                                 'tipo_repuestos.tipo as tipo',
                                                 'marca_modelos.id as idMarcaModelo',        
                                                 'marcas.nombre as marca',
                                                 'modelos.nombre as modelo',
                                                 'almacenes.sigla as almacen'

        )
        ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
        ->join('categorias','categorias.id','=','repuestos.idCategoria')
        ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
        ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
        ->join('marcas','marcas.id','=','marca_modelos.idMarca')
        ->join('modelos','modelos.id','=','marca_modelos.idModelo')
        ->join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
        ->where('repuestos.descripcion','LIKE','%'.$query.'%')
        ->orderBy('repuestos.id','asc')
        ->paginate(10);

        }else {
            $repuestoAlmacen=RepuestoAlmacen::select('repuesto_almacen.id',
            'repuesto_almacen.stock',
            'repuestos.descripcion as repuesto',        
            'categorias.nombre as categoria',
            'tipo_repuestos.tipo as tipo',
            'marca_modelos.id as idMarcaModelo',        
            'marcas.nombre as marca',
            'modelos.nombre as modelo',
            'almacenes.sigla as almacen'

            )
            ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
            ->join('categorias','categorias.id','=','repuestos.idCategoria')
            ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
            ->join('marca_modelos','marca_modelos.id','=','repuestos.idMarcaModelo')
            ->join('marcas','marcas.id','=','marca_modelos.idMarca')
            ->join('modelos','modelos.id','=','marca_modelos.idModelo')
            ->join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
            ->orderBy('repuestos.id','asc')
            ->get();

        }

        // if($request){
            // $query = trim($request->get('searchText'));
            // $repuestoAlmacen = RepuestoAlmacen::select('id','sigla')
            // ->where('','LIKE','%'.$query.'%')
            // ->paginate(2);
        // }else{
            // $repuestoAlmacen = RepuestoAlmacen::paginate(1);
        // }

        // return $repuestoAlmacen;

        return view('pages.repuestoAlmacen.mostrar',[
            'repuestoAlmacenes' => $repuestoAlmacen, 
            // 'searchText'=>$query
        ]);
    }

    public function crear(){
        return view('pages.repuestoAlmacen.insertar');
    }

    public function transferir(){
        return view('pages.repuestoAlmacen.transferir');
    }

    public function insertar(Request $request){
        $repuestoAlmacen            = new RepuestoAlmacen();
        $repuestoAlmacen->sigla    = $request->get('sigla');
        $repuestoAlmacen->save();

        return redirect('/almacen/mostrar');

    }
    public function actualizar(Request $request){
        $repuestoAlmacen            = RepuestoAlmacen::findOrFail($request->id);
        $repuestoAlmacen->sigla    = $request->get('sigla');
        $repuestoAlmacen->update();


        return redirect('/almacen/mostrar');
    }
    public function eliminar(Request $request){
        $repuestoAlmacen             = RepuestoAlmacen::findOrFail($request->id);
        $repuestoAlmacen->delete();

        return redirect('/almacen/mostrar');
    } 
}
