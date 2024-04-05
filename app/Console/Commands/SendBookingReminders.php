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


        $currentDateTime = Carbon::now();

        $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

        echo $formattedDateTime;

        $bookings = Booking::query()
            ->whereDate('check_in', '=', Carbon::now()->addWeek()->toDateString())
            ->whereNull('last_reminder_sent_at')
            ->get();


        foreach ($bookings as $booking) {
            Notification::send($booking->user, new BookingReminderNotification($booking));
            $booking->last_reminder_sent_at = Carbon::now();
            $booking->save();
        }
    }
}
