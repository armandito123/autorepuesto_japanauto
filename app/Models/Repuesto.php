<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'repuestos';

    protected $fillable = [

        'descripcion',
        'codigo',
        'precioVenta',
        'imagen',
        'idCategoria',
        'idMarcaModelo',
        'idTipoRepuesto',
    ];
    public $timestamps = false;
}
