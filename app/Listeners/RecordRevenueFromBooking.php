<?php

namespace App\Listeners;

use App\Events\BookingConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RecordRevenueFromBooking implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(BookingConfirmed $event): void
    {
        // Log revenue tracking for audit purposes
        Log::channel('revenue')->info('Booking confirmed and revenue recorded', [
            'booking_id' => $event->booking->id,
            'booking_code' => $event->booking->booking_code,
            'field_id' => $event->booking->field_id,
            'amount' => $event->booking->total_price,
            'booking_date' => $event->booking->booking_date,
            'user_id' => $event->booking->user_id,
            'confirmed_at' => now(),
        ]);

        // This event can be used for future revenue table integration
        // For now, revenue is calculated on-the-fly from confirmed bookings
    }
}
