<?php

namespace App\Console\Commands;

use App\Models\BookingHall;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class payment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:confirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check';

    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        parent::__construct();
        $this->paymentService = $paymentService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentTime = Carbon::now();

        $bookings = BookingHall::where('booking_start', '<=', $currentTime)
            ->where('booking_end', '>=', $currentTime)
            ->where('status_payment', 'AUTHORIZED')
            ->get();

        $this->info('Current time: ' . $currentTime);
        $this->info('Found bookings: ' . count($bookings));

        foreach ($bookings as $booking) {
            $confirmation = $this->paymentService->confirmPayment($booking->payment_id);

            if ($confirmation) {
                $status = $this->paymentService->getStatusPayment($booking->payment_id);
                $booking->status_payment = $status;
                $booking->save();
                $this->info('Payment confirmed for ID: ' . $booking->payment_id);
            } else {
                $this->error('Failed to confirm payment ID: ' . $booking->payment_id);
            }
        }

        $this->info('All payment confirmations processed.');
    }
}
