<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginServer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('auth.login');
    }
}
