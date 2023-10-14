<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaModelo extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'marca_modelos';

    protected $fillable = [
        'medida',
        'submedida',
        'idMarca',
        'idModelo'
    ];
    public $timestamps = false;
}
