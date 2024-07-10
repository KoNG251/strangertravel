<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use \App\Models\Booking as bookingModel;


class Booking extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function build()
    {

        $booking = bookingModel::select('hotels.hotelName', 'bookings.fname', 'bookings.lname', 'bookings.check_in', 'bookings.check_out','rooms.price')
        ->join('rooms', 'rooms.id', '=', 'bookings.roomId')
        ->join('hotels', 'hotels.id', '=', 'rooms.hotelId')
        ->where('bookings.id', '=', $this->id)
        ->first();

        return $this->subject('thank you for booking hotel with Stranger Travel')
                    ->view('emails.booking')
                    ->with([
                        'items' => $booking,
                    ]);
    }
}
