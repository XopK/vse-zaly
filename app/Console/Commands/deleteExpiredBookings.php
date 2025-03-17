<?php

namespace App\Console\Commands;

use App\Models\BookingHall;
use Illuminate\Console\Command;
use Carbon\Carbon;

class deleteExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:deleteExpired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete expired bookings with status payment NEW';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = BookingHall::where('status_payment', 'NEW')
            ->whereNotNull('link_payment')
            ->where('created_at', '<=', Carbon::now()->subMinutes(5))
            ->get();

        $bookings->each(function ($booking) {
            $booking->disableEvents = true;
            $booking->delete();
        });

        $this->info('Bookings have been deleted');
    }


}
