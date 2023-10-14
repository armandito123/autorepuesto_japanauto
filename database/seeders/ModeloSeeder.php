<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modelo;


class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modelo = Modelo::create([
            'nombre' => 'GOODRIDE SA57',
        ]);
        $modelo = Modelo::create([
            'nombre' => 'HELIX HX6',
        ]);
        $modelo = Modelo::create([
            'nombre' => 'RIDEX WVA 23510',
        ]);
        $modelo = Modelo::create([
            'nombre' => 'ROSCA M36X',
        ]);
        $modelo = Modelo::create([
            'nombre' => 'MT6X',
        ]);

    }
}
