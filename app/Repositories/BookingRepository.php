<?php

namespace App\Repositories;

use App\Contracts\IBookingRepository;
use App\DTO\BookingDTO;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\BookingsResource;

class BookingRepository implements IBookingRepository
{
    public function getBookings(): JsonResponse
    {
        /** @var array $bookings */
        $bookings = Booking::all();

        return response()->json([
            'data' => $bookings
        ]);
    }

    public function getBookingById(int $bookingId): ?Booking
    {
        /** @var Booking|null $booking */
        $booking = Booking::query()->find($bookingId);
        return $booking;
    }

    public function createBooking(BookingDTO $bookingDTO): Booking
    {
        $booking = new Booking();
        $booking->user_id = $bookingDTO->getUserId();
        $booking->room_id = $bookingDTO->getRoomId();
        $booking->hotel_id = $bookingDTO->getHotelId();
        $booking->check_in = $bookingDTO->getCheckIn();
        $booking->check_out = $bookingDTO->getCheckOut();
        $booking->total_price = $bookingDTO->getTotalPrice();
        $booking->status = $bookingDTO->getStatus();
        $booking->save();
        return $booking;

    }

    public function updateBooking(BookingDTO $bookingDTO, int $bookingId): Booking
    {
        /** @var Booking $booking */
        $booking = Booking::query()->find($bookingId);
        $booking->user_id = $bookingDTO->getUserId();
        $booking->room_id = $bookingDTO->getRoomId();
        $booking->hotel_id = $bookingDTO->getHotelId();
        $booking->check_in = $bookingDTO->getCheckIn();
        $booking->check_out = $bookingDTO->getCheckOut();
        $booking->total_price = $bookingDTO->getTotalPrice();
        $booking->status = $bookingDTO->getStatus();
        $booking->save();
        return $booking;
    }

    public function destroyBooking(int $bookingId)
    {
        $booking = Booking::query()->find($bookingId);
        $booking->delete();
    }


}
