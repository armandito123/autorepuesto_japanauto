<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Almacen;


class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $almacen = Almacen::create([
            'sigla' => 'A',
        ]);

        $almacen = Almacen::create([
            'sigla' => 'B',
        ]);

        // $almacen = Almacen::create([
        //     'sigla' => 'C',
        // ]);

        // $almacen = Almacen::create([
        //     'sigla' => 'D',
        // ]);
    }
}
