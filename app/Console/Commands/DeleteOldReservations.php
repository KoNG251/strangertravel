<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class DeleteOldReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete reservation rows older than 3 hours where status is 0';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threshold = Carbon::now()->subMinutes(5);

        $book = Booking::where('status', 0)
                   ->where('created_at', '<', $threshold)
                   ->delete();
        
        
        $this->info('Old reservations deleted successfully.');
    }
}
