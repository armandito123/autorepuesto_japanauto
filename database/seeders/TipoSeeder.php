<?php

namespace Database\Seeders;

use App\Models\TipoRepuesto;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { //SUBCATEGORIAS
        $tipo = TipoRepuesto::create([
            'tipo' => 'NEUMATICOS DE VERANO',
        ]);
        $tipo = TipoRepuesto::create([
            'tipo' => 'ACEITE DE MOTOR',
        ]);
        $tipo = TipoRepuesto::create([
            'tipo' => 'PASTILLAS DE FRENO',
        ]);
        $tipo = TipoRepuesto::create([
            'tipo' => 'FILTRO DE COMBUSTIBLE',
        ]);
        $tipo = TipoRepuesto::create([
            'tipo' => 'SISTEMA ELECTRICO DEL MOTOR',
        ]);

    }
}
