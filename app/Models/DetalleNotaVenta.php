<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNotaVenta extends Model
{
    use HasFactory;
    protected $table = 'detalle_venta';
    protected $primaryKey ='id';
    protected $fillable = [
        'cantidad',
        'subTotal',
        'idRepuestoAlmacen',
        'idNotaVenta',
    ];
    public $timestamps=false;
}
