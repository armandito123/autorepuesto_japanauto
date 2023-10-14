<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'vehiculos';

    protected $fillable = [
        'tipo',
        'placa',
        'idRepartidor'
    ];
    public $timestamps = false;
}
