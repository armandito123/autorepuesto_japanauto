<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    public function mostrar(Request $request){
        $marca=Marca::all();
        if($request){
            $query = trim($request->get('searchText'));
            $marca = Marca::select('id','nombre','logo')
            ->where('nombre','LIKE','%'.$query.'%')
            ->paginate(10);
        }else{
            $marca = Marca::paginate(10);
        }

        return view('pages.marca.mostrar',[
            'marcas' => $marca, 'searchText'=>$query
        ]);
    }
    public function insertar(Request $request){
        $marca            = new Marca();
        $marca->nombre    = $request->get('nombre');
        if($request->file('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $marca->logo = $path; 
        }else{
            $marca->logo = 'imagenes/marca.png';
        }
        $marca->save();

        return redirect('/marca/mostrar');

    }
    public function actualizar(Request $request){
        $marca            = Marca::findOrFail($request->id);
        $marca->nombre    = $request->get('nombre');
        if($request->hasFile('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $marca->logo = $path; 
        }
        $marca->update();



        return redirect('/marca/mostrar');
    }
    public function eliminar(Request $request){
        $marca             = Marca::findOrFail($request->id);
        $marca->delete();

        return redirect('/marca/mostrar');
    }
}
