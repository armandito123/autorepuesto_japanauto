<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRepuesto extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'tipo_repuestos';

    protected $fillable = [
        'tipo',
        'idImagen'

    ];
    public $timestamps = false;
}
