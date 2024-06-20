<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $this->from = env('TWILIO_FROM');
    }

    public function sendOTP($to, $otp)
    {
        $message = "Your OTP is: {$otp}";

        try {
            $this->client->messages->create($to, [
                'from' => $this->from,
                'body' => $message
            ]);
            return true;
        } catch (\Exception $e) {
            // Log the error message for debugging
            \Log::error("Failed to send OTP with Twilio: " . $e->getMessage());
            return false;
        }
    }

}