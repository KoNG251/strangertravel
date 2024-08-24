<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\Notification;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class SendRemindBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to one whole not pay in 3 minute';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threshold = Carbon::now()->subMinutes(3);

        $book = Booking::where('status', 0)
                   ->where('created_at', '<', $threshold)
                   ->get();

        foreach($book as $data){
            Mail::to($data->email)->send(new Notification($data->email,$data->roomId,$data->id));
        }
        
        
        $this->info('Send email remind successfully.');
    }
}
