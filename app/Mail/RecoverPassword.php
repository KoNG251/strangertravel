<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class RecoverPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $id;
    public $email;

    public function __construct($id,$email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function build()
    {

        $id_hash = Hash::make($this->id) ;

        return $this->subject('Recover Password')
                    ->view('emails.resetPassword')
                    ->with([
                        'id_hash' => $id_hash,
                        'email' => $this->email
        ]);

    }
}
