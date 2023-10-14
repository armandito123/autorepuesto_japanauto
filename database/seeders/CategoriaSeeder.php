<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;


class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = Categoria::create([
            'nombre' => 'NEUMATICOS',
        ]);
        $categoria = Categoria::create([
            'nombre' => 'ACEITE Y LIQUIDOS',
        ]);
        $categoria = Categoria::create([
            'nombre' => 'FRENO',
        ]);
        
        $categoria = Categoria::create([
            'nombre' => 'FILTROS',
        ]);

        $categoria = Categoria::create([
            'nombre' => 'MOTOR',
        ]);


    }
}
