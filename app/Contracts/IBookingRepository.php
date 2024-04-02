<?php

namespace App\Contracts;

use App\DTO\BookingDTO;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;

interface IBookingRepository
{

    /**
     * @param int $bookingId
     * @return Booking|null
     */
    public function getBookingById(int $bookingId): ?Booking;


    public function createBooking(Booking $booking);


    public function updateBooking(Booking $booking);

    /**
     * Delete a booking.
     *
     * @param int $bookingId
     */
    public function rejectBooking(int $bookingId);
}
