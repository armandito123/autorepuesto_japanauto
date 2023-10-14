<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'nota_venta';

    protected $fillable = [
        'fecha',
        'montoTotal',
        'idCliente',
        'idUser',
    ];
    public $timestamps = false;
}
