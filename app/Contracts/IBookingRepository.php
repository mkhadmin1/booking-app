<?php

namespace App\Contracts;

use App\DTO\BookingDTO;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;

interface IBookingRepository
{
    /**@return JsonResponse */
    public function getBookings(): JsonResponse;

    /**
     * Get booking by ID.
     *
     * @param int $bookingId
     * @return Booking|null
     */
    public function getBookingById(int $bookingId): ?Booking;

    /**
     * Create a new booking.
     *
     * @param BookingDTO $bookingDTO
     * @return Booking
     */
    public function createBooking(BookingDTO $bookingDTO): Booking;

    /**
     * Update an existing booking.
     *
     * @param BookingDTO $bookingDTO
     * @param int $bookingId
     * @return Booking
     */
    public function updateBooking(BookingDTO $bookingDTO, int $bookingId): Booking;

    /**
     * Delete a booking.
     *
     * @param int $bookingId
     * @return mixed
     */
    public function destroyBooking(int $bookingId);
}
