<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'almacenes';

    protected $fillable = [
        'sigla'
    ];
    public $timestamps =false;

    static function criterioBusqueda($criterio,$searchText){
        
        switch ($criterio) {
            case 'repuestos':
                $repuesto = Repuesto::join('categorias','categorias.id','=','repuestos.idCategoria')
                ->select('repuestos.id','repuestos.codigo','repuestos.imagen','categorias.nombre as categoria','repuestos.descripcion')
                ->where($criterio.'.descripcion','LIKE','%'.$searchText.'%')
                ->orWhere($criterio.'.codigo','=',$searchText)
                ->orderBy('repuestos.id','asc')
                ->paginate(10);
                return $repuesto;                
                break;
            case 'categorias':
                $repuesto = Repuesto::join('categorias','categorias.id','=','repuestos.idCategoria')
                ->select('repuestos.id','repuestos.codigo','repuestos.imagen','categorias.nombre as categoria','repuestos.descripcion')
                ->where($criterio.'.nombre','LIKE','%'.$searchText.'%')
                ->orderBy('repuestos.id','asc')
                ->paginate(10);
                return $repuesto;
                break;
            case 'tipo_repuestos':
                $repuesto = Repuesto::join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
                ->select('repuestos.id','repuestos.codigo','repuestos.imagen','tipo_repuestos.tipo as tipo','repuestos.descripcion')
                ->where($criterio.'.tipo','LIKE','%'.$searchText.'%')
                ->orderBy('repuestos.id','asc')
                ->paginate(10);
                return $repuesto;
                break;
            case 'marcas':
                $repuesto = Repuesto::join('marca_modelos','marca_modelos.id','idMarcaModelo')
                ->join('marcas','marcas.id','=','marca_modelos.idMarca')
                ->select('repuestos.id','repuestos.codigo','repuestos.imagen','marcas.nombre as marca','repuestos.descripcion')
                ->where($criterio.'.nombre','LIKE','%'.$searchText.'%')
                 ->orderBy('repuestos.id','asc')
                ->paginate(10);
                return $repuesto;
    
                break;
            default:
            $repuesto = Repuesto::join('categorias','categorias.id','=','repuestos.idCategoria')
            ->select('repuestos.id','repuestos.codigo','repuestos.imagen','categorias.nombre as categoria','repuestos.descripcion')
            // ->where($criterio.'.descripcion','LIKE','%'.$searchText.'%')
            // ->orWhere($criterio.'.codigo','=',$searchText)
            ->orderBy('repuestos.id','asc')
            ->paginate(10);
            return $repuesto;                
                return $repuesto;
                break;
        }
        
    }
}
