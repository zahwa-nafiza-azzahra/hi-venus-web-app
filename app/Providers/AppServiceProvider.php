<?php

namespace App\Providers;

use App\Events\BookingConfirmed;
use App\Listeners\RecordRevenueFromBooking;
use App\Models\Booking;
use App\Policies\BookingPolicy;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    public function register(): void {
        //
    }

    public function boot(): void {
        Gate::policy(Booking::class, BookingPolicy::class);
        
        // Register event listeners
        Event::listen(BookingConfirmed::class, RecordRevenueFromBooking::class);
    }
}

