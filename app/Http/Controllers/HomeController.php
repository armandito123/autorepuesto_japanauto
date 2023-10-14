<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(){
        return view('dashboard');
    }
     public function index()
    {
        $user = Auth::user();
        $rol = $user->roles->implode('name', ', ');

        // switch ($rol)
        // {
        //   case 'admin':
        //     $saludo = 'Bienvenido super-admin';

        //     return view('home', compact('saludo'));
        //     break;

        //   case 'cliente':
        //       $saludo = 'Bienvenido moderador';

        //       return view('home', compact('saludo'));
        //     break;

        //   case 'repartidor':
        //       $saludo = 'Bienvenido editor';

        //       return view('home', compact('saludo'));
        //     break;
        // }
        
        return view('index',[
          'rol' => $rol
        ]);
    }
}
