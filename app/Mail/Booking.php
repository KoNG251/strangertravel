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

    public $booking;
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function build()
    {

        $booking = bookingModel::where('id', $this->id)->get();

        return $this->subject('ขอบคุณที่จองโรงแรมจาก Stranger Travel')
                    ->view('emails.booking')
                    ->with([
                        'booking' => $this->booking,
                    ]);
    }
}
