<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class correoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject="informacion de pedido";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $use= auth()->id();

        $user= User::all();
        return $this->view('email.pedidos',compact('user','use'));
    }
}
