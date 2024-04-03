<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingReminderNotification extends Notification
{
    use Queueable;

    protected $booking;

    /**
     * Create a new notification instance.
     *
     * @param $booking
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(mixed $notifiable)
    {
        return (new MailMessage)
            ->subject('Reminder: Your booking is coming up!')
            ->line('This is a reminder that your booking is coming up soon.')
           // ->line('Check-in Date: ' . $this->booking->check_in->format('Y-m-d'))
            //->line('Check-out Date: ' . $this->booking->check_out->format('Y-m-d'))
            //->line('Total Price: $' . $this->booking->total_price)
            //->action('View Booking', url('/bookings/' . $this->booking->id))
            ->line('Thank you for using our booking system!');
    }
}
