<?php

namespace App\Console\Commands;

use App\Notifications\BookingReminderNotification;
use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

class SendBookingReminders extends Command
{
    use RefreshDatabase;
    protected $signature = 'reminders:send';
    protected $description = 'Send reminders for bookings scheduled a week from now';

    public function handle()
    {
        // Get all bookings that are scheduled a week from now and have not been sent a reminder yet
        $bookings = Booking::query()->where('check_in', Carbon::now()->addWeek())
            ->whereNull('last_reminder_sent_at')
            ->get();
        //dd($bookings);

        // Loop through each booking and send a reminder
        foreach ($bookings as $booking) {
            Notification::send($booking->user, new BookingReminderNotification($booking));
            $booking->last_reminder_sent_at = Carbon::now();
            $booking->save();
        }
    }
}
