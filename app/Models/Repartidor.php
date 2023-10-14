<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'repartidores';

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'telefono',
        'numeroLicencia'
    ];
    public $timestamps = false;
}
