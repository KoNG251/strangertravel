<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Room;
use App\Models\Booking;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $email;
    public $roomid;
    public $id;

    public function __construct($email,$roomid,$id)
    {
        $this->email = $email;
        $this->roomid = $roomid;
        $this->id = $id;
    }

    public function build()
    {

        $room = Room::where('id',$this->roomid)->first();

        return $this->subject('Remind your booking')
                    ->view('emails.notification')
                    ->with([
                        "email" => $this->email,
                        "price" => $room->price,
                        "id" => $this->id
                    ]);

    }
}
