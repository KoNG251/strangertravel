<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\booking;
use Carbon\Carbon;

class DeleteOldReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:delete-old';

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
        $threshold = Carbon::now()->subHours(3);

        // Delete the old reservations with status 0
        booking::where('status', 0)
                   ->where('created_at', '<', $threshold)
                   ->delete();
        
        $this->info('Old reservations deleted successfully.');
    }
}
