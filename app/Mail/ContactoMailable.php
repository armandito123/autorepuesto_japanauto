<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    //Creacion de Variables
    public $contacto; //se guardara el mensaje del correo
    public $subject; //se guarda el asunto del mensaje

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contacto) //el constructor recibe por parametro $request->all() que fue enviado por el controlador ContactoController.php
    {
        //CORREO REMITENTE - Quien hace el envio del mensaje de correo
        $this->from($contacto['correo_remitente']);
        $this->contacto = $contacto;//aqui se registra el mensaje del correo, el parametro del constructor $contacto es pasado a la varible publica public $contacto
        $this->subject = $contacto['asunto'];//aqui se registra el asunto del mensaje del correo.
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   //Devolvemos una vista
        return $this->view('emails.email'); //devuelve la vista email.blade.php
    }

}
