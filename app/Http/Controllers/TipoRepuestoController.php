<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoRepuesto;
use Illuminate\Support\Facades\Storage;

class TipoRepuestoController extends Controller
{
    public function mostrar(Request $request){
        $tipoRepuesto=TipoRepuesto::all();
        if($request){
            $query = trim($request->get('searchText'));
            $tipoRepuesto = TipoRepuesto::select('id','tipo','logo')
            ->where('tipo','LIKE','%'.$query.'%')
            ->paginate(5);
        }else{
            $tipoRepuesto = TipoRepuesto::paginate(1);
        }

        return view('pages.tipoRepuesto.mostrar',[
            'tipoRepuestos' => $tipoRepuesto, 'searchText'=>$query
        ]);
    }
    public function insertar(Request $request){
        $tipoRepuesto            = new TipoRepuesto();
        $tipoRepuesto->tipo    = $request->get('tipo');
        if($request->file('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $tipoRepuesto->logo = $path; 
        }else{
            $tipoRepuesto->logo = 'imagenes/tipo.png';
        }
        $tipoRepuesto->save();

        return redirect('/tipoRepuesto/mostrar');

    }
    public function actualizar(Request $request){
        $tipoRepuesto            = TipoRepuesto::findOrFail($request->id);
        $tipoRepuesto->tipo    = $request->get('tipo');
        if($request->hasFile('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $tipoRepuesto->logo = $path; 
        }
        $tipoRepuesto->update();

        return redirect('/tipoRepuesto/mostrar');
    }
    public function eliminar(Request $request){
        $tipoRepuesto             = TipoRepuesto::findOrFail($request->id);
        $tipoRepuesto->delete();

        return redirect('/tipoRepuesto/mostrar');
    }
}
