<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $table = 'bitacora';
    protected $primaryKey ='id';
    protected $fillable = [
        'fecha',
        'hora',
        'tabla',
        'transaccion',
        'idUser'
    ];
    public $timestamps=false;

    static function guardar($tabla,$transaccion,$codigoTabla){

        $idUsuario = auth()->id();

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $bitacora = new bitacora();
        $bitacora->fecha = $fecha;
        $bitacora->hora = $hora;
        $bitacora->tabla = $tabla;
        $bitacora->codigoTabla = $codigoTabla;
        $bitacora->transaccion = $transaccion;
        $bitacora->idUser =  $idUsuario;
        $bitacora->save();
    }
}
