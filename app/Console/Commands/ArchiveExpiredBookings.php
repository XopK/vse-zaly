<?php

namespace App\Console\Commands;

use App\Models\BookingHall;
use Illuminate\Console\Command;

class ArchiveExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive expired bookings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = BookingHall::where('is_archive', 0)->get();
        $bookings->each->update_booking();
        $this->info('Expired bookings archived successfully.');
    }
}
