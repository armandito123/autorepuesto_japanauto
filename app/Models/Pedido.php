<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedido';
    protected $primaryKey ='id';
    protected $fillable = [
        'fecha',
        'fechaentrega',
        'hora',
        'horaentrega',
        'tiempoentrega',
        'montototal',
        'estado',
        'idUser',
        'idCliente',
        'idRepartidor',
        'idUbicacion'
    ];
    public $timestamps=false;
}
