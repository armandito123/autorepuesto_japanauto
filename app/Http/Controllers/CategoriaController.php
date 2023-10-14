<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function mostrar(Request $request){
        $categoria=Categoria::all();
        if($request){
            $query = trim($request->get('searchText'));
            $categoria = Categoria::select('id','nombre','logo')
            ->where('nombre','LIKE','%'.$query.'%')
            ->paginate(5);
        }else{
            $categoria = Categoria::paginate(5);
        }

        return view('pages.categoria.mostrar',[
            'categorias' => $categoria, 'searchText'=>$query
        ]);
    }
    public function insertar(Request $request){
        
        $categoria            = new Categoria();
        $categoria->nombre    = $request->get('nombre');
        
        if($request->file('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $categoria->logo = $path; 
        }else{
            $categoria->logo = 'imagenes/categoria.png';
        }
        $categoria->save();

        return redirect('/categoria/mostrar');

    }
    public function actualizar(Request $request){
        // $request->imagen;
        
        // return $request;

        $categoria            = Categoria::findOrFail($request->id);
        $categoria->nombre    = $request->get('nombre');
        
        if($request->hasFile('imagen')){
            $path = Storage::disk('public')->put('imagenes',$request->file('imagen'));
            $categoria->logo = $path; 
        }
        $categoria->update();
        return redirect('/categoria/mostrar');
    }
    public function eliminar(Request $request){
        $categoria             = Categoria::findOrFail($request->id);
        $categoria->delete();

        return redirect('/categoria/mostrar');
    }

    public function buscar(){
        

        $cliente = Cliente::findOrFail(3);
        
        return $cliente->nombre;
    }
}
