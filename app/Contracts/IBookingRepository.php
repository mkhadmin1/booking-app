<?php

namespace App\Contracts;

use App\DTO\BookingDTO;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;

interface IBookingRepository
{

    public function getBookingById(int $bookingId): ?Booking;


    public function saveBooking(Booking $booking);


    public function cancelBooking(int $bookingId);
}
