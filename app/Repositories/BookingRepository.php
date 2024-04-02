<?php

namespace App\Repositories;

use App\Contracts\IBookingRepository;
use App\Exceptions\ModelNotFoundException;
use App\Models\Booking;

class BookingRepository implements IBookingRepository
{


    public function getBookingById(int $bookingId): Booking|null
    {
        return Booking::find($bookingId);

    }



    public function saveBooking(Booking $booking)
    {
        return $booking->save();

    }

    public function updateBooking(Booking $booking)
    {
        return $booking->save();

    }

    public function cancelBooking(int $bookingId)
    {
        $booking = Booking::query()->find($bookingId);
        $booking->status = 'REJECTED';
        $booking->save();
        return $booking;
    }


}
