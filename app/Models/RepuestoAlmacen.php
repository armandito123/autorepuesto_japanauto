<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepuestoAlmacen extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'repuesto_almacen';

    protected $fillable = [
        'stock',
        'idRepuesto',
        'idAlmacen'
    ];
    public $timestamps =false;


    static function criterioBusqueda($searchText,$criterio, $idAlmacen){

        switch ($criterio) {
            case 'repuestos':
                $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
                ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
                ->join('categorias','categorias.id','=','repuestos.idCategoria')
                ->select('categorias.nombre as categoria',
                        'repuestos.id as idRepuesto',
                        'repuestos.descripcion',
                        'repuestos.imagen',
                        'repuestos.codigo',
                        'repuestos.precioVenta',
                        'repuestos.precioCompra',
                        'almacenes.id as idAlmacen',
                        'almacenes.sigla',
                        'repuesto_almacen.id as idRepuestoAlmacen',
                        'repuesto_almacen.stock',
                        )
                ->where('almacenes.id','=',$idAlmacen)
                ->where($criterio.'.descripcion','LIKE','%'.$searchText.'%')
                ->orWhere($criterio.'.codigo','=',$searchText)
                ->paginate(10);
                return $repuesto;
                break;

            case 'categorias':
                $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
                ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
                ->join('categorias','categorias.id','=','repuestos.idCategoria')

                ->select('categorias.nombre as categoria',
                        'repuestos.id as idRepuesto',
                        'repuestos.descripcion',
                        'repuestos.imagen',
                        'repuestos.codigo',
                        'repuestos.precioVenta',
                        'repuestos.precioCompra',
                        'almacenes.id as idAlmacen',
                        'almacenes.sigla',
                        'repuesto_almacen.id as idRepuestoAlmacen',
                        'repuesto_almacen.stock'
                        )
                ->where('almacenes.id','=',$idAlmacen)
                ->where($criterio.'.nombre','LIKE','%'.$searchText.'%')
                ->paginate(10);
                return $repuesto;
                break;
            case 'tipo_repuestos':
                $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
                ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
                ->join('categorias','categorias.id','=','repuestos.idCategoria')
                ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
                ->select('categorias.nombre as categoria',
                        'repuestos.id as idRepuesto',
                        'repuestos.descripcion',
                        'repuestos.imagen',
                        'repuestos.codigo',
                        'repuestos.precioVenta',
                        'repuestos.precioCompra',
                        'almacenes.id as idAlmacen',
                        'almacenes.sigla',
                        'repuesto_almacen.id as idRepuestoAlmacen',
                        'repuesto_almacen.stock',
                        'tipo_repuestos.tipo as tipo'
                        )
                ->where('almacenes.id','=',$idAlmacen)
                ->where($criterio.'.tipo','LIKE','%'.$searchText.'%')
                ->paginate(10);
                return $repuesto;
                break;
            case 'marcas':
                $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
                ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
                ->join('categorias','categorias.id','=','repuestos.idCategoria')
                ->join('tipo_repuestos','tipo_repuestos.id','=','repuestos.idTipoRepuesto')
                ->join('marca_modelos','marca_modelos.id','repuestos.idMarcaModelo')
                ->join('marcas','marcas.id','=','marca_modelos.idMarca')
                ->select('categorias.nombre as categoria',
                        'repuestos.id as idRepuesto',
                        'repuestos.descripcion',
                        'repuestos.imagen',
                        'repuestos.codigo',
                        'repuestos.precioVenta',
                        'repuestos.precioCompra',
                        'almacenes.id as idAlmacen',
                        'almacenes.sigla',
                        'repuesto_almacen.id as idRepuestoAlmacen',
                        'tipo_repuestos.tipo as tipo',
                        'repuesto_almacen.stock'
                        )
                ->where('almacenes.id','=',$idAlmacen)
                ->where($criterio.'.nombre','LIKE','%'.$searchText.'%')
                ->paginate(10);
                return $repuesto;
                break;
            default:
                $repuesto = RepuestoAlmacen::join('almacenes','almacenes.id','=','repuesto_almacen.idAlmacen')
                ->join('repuestos','repuestos.id','=','repuesto_almacen.idRepuesto')
                ->join('categorias','categorias.id','=','repuestos.idCategoria')

                ->select('categorias.nombre as categoria',
                        'repuestos.id as idRepuesto',
                        'repuestos.descripcion',
                        'repuestos.imagen',
                        'repuestos.codigo',
                        'repuestos.precioVenta',
                        'repuestos.precioCompra',
                        'almacenes.id as idAlmacen',
                        'almacenes.sigla',
                        'repuesto_almacen.id as idRepuestoAlmacen',
                        'repuesto_almacen.stock'

                        )
                ->where('almacenes.id','=',$idAlmacen)
                ->paginate(10);

                return $repuesto;
                break;
        }
    }

}
