<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactoMailable; // <---- aqui de usa el Modelo ContactoMailable 
use Illuminate\Support\Facades\Mail;

class ContactoAdminController extends Controller
{
    public function index(){
        return view('pages.contactoadmin.index');
    }

    //Metodo Store: agarra todos los campos que vienen desde el formulario
    public function store(Request $request){
        //Validacion de los campos del formulario:sino se cumple, muestra el mensaje de error
        $request->validate([
            'asunto'=>'required',
            'nombre'=>'required',
            'correo_remitente'=>'required|email',
            'correo_destino'=>'required|email',
            'mensaje'=>'required',
        ]);

        //CORREO DESTINATARIO - Envio de Correo con todos los campos
        $correo = new ContactoMailable($request->all()); //se envia todos los campos a ContactoMailable  y tambien se los pasa a la variable $correo
        Mail::to($request->correo_destino)->send($correo);//to=para quien se envia el correo, se coloca el correo_destino hacia donde en llegara el mensaje y la variable $correo tiene todos los datos del mensaje de correo
        //Mensaje de envio exitoso
        return redirect()->route('contactoadministrador.index')->with('info','Tu correo fué enviado exitosamente.');//Se le pasa un mensaje de envio a la vista contacto.index

    }
}
