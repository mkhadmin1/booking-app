<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingNotification extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Notification')
            ->line('Your booking has been successfully created.');
//            ->line('Booking ID: ' . $this->booking->id)
//            ->line('Booking Date: ' . $this->booking->created_at->format('Y-m-d H:i:s'))
//            ->action('View Booking', url('/bookings/' . $this->booking->id))
//            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            // Notification data
        ];
    }
}
