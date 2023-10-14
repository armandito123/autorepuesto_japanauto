<?php

namespace Database\Seeders;

use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\Repartidor;
use App\Models\Proveedor;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // usuario con el rol repartidor
        $repartidor = User::create([
            'name' => 'repartidor',
            'email' => 'repar_mario_paz@correo.autorepuesto.com',
            'password' => Hash::make('12345678'),
            'rol' => 'repartidor'
            
          ]);

          $repar = Repartidor::create([
            'id' => $repartidor->id,
            'nombre' => 'Mario',
            'apellidos' =>'Paz Sosa',
            'correo' =>'mario97@correo.autorepuesto.com',
            'telefono' =>'77912439',
            'numeroLicencia' =>'45294843',

          ]);
  
          $repartidor->assignRole('repartidor');


          // //usuario con el rol de proveedor
          // $proveedor = User::create([
          //   'name' => 'proveedor',
          //   'email' => 'proveedor@gmail.com',
          //   'password' => Hash::make('12345678'),
          //   'rol' => 'proveedor'

          // ]);

          // $provee = Proveedor::create([
          //   'id' => $proveedor->id,
          //   'nombre' => 'Alejandro',
          //   'correo' =>'proveedor@gmail.com',
          //   'apellidos' =>'Chavez Perez',
          //   'telefono' =>'6321458',
          //   'direccion' =>'b/Villa Virginia',
          // ]);


        // usuario con el rol cliente
          $cliente = User::create([
              'name' => 'cliente',
              'email' => 'cli_pablo_garcia@correo.autorepuesto.com',
              'password' => Hash::make('12345678'),
              'rol' => 'cliente'

          ]);
  
          $cliente->assignRole('cliente');

          $client = Cliente::create([
            'id' => $cliente->id,
            'nombre' => 'Pablo',
            'apellidos' =>'Garcia Torrez',
            'telefono' =>'64910412',
            'correo' =>'pablo_g@correo.autorepuesto.com'
          ]);

          $carrito = Carrito::create([
            'monto' => 0,
            'estado' => 0,
            'idCliente' => $cliente->id
          ]);


          // usuario ADMINISTRADOR
          $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@correo.autorepuesto.com',
            'password' => Hash::make('12345678'),
            'rol' => 'admin'

          ]);
  
          $admin->assignRole('admin');
    }
}
