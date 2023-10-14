<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'correo'
    ];
    public $timestamps = false;
}
