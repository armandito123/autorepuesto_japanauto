<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;


class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marca = Marca::create([
            'nombre' => 'GOODRIDE',
        ]);
        $marca = Marca::create([
            'nombre' => 'MICHELIN',
        ]);
        $marca = Marca::create([
            'nombre' => 'FORD',
        ]);   

    }
}
