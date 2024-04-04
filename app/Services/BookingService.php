<?php

namespace App\Services;

use App\Contracts\IBookingRepository;
use App\DTO\BookingDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\BookingsResource;
use Illuminate\Support\Carbon;

class BookingService
{
    private IBookingRepository $repository;

    public function __construct(IBookingRepository $repository)
    {
        $this->repository = $repository;
    }


    public function getBookingById(int $bookingId): ?Booking
    {
        $booking = $this->repository->getBookingById($bookingId);
        if (!$booking) {
            throw new ModelNotFoundException(__('bookings.booking_not_found'));
        }
        return $booking;
    }

    public function createBooking(BookingDTO $bookingDTO)
    {
        try {
            $room = Room::query()->find($bookingDTO->getRoomId());
            if (!$room) {
                throw new ModelNotFoundException(__('rooms.room_not_found'));
            }

            $room->is_available = 0;
            $room->save();

            $checkIn = Carbon::parse($bookingDTO->getCheckIn());
            $checkOut = Carbon::parse($bookingDTO->getCheckOut());

            $totalNights = $checkIn->diffInDays($checkOut);
            $totalPrice = $totalNights * $room->price_per_night;

            $booking = new Booking();
            $booking->user_id = $bookingDTO->getUserId();
            $booking->room_id = $bookingDTO->getRoomId();
            $booking->check_in = $bookingDTO->getCheckIn();
            $booking->check_out = $bookingDTO->getCheckOut();
            $booking->total_price = $totalPrice;
            $booking->status = $bookingDTO->getStatus();

            return $this->repository->saveBooking($booking);

        } catch (\Exception $e) {
            throw new BusinessException(__('bookings.failed_to_create_booking'));
        }
    }

    public function updateBooking(BookingDTO $bookingDTO, int $bookingId)
    {
        $booking = $this->repository->getBookingById($bookingId);
        if (!$booking) {
            throw new ModelNotFoundException(__('bookings.booking_not_found'));
        }

        try {
            $room = Room::query()->find($bookingDTO->getRoomId());

            $checkIn = Carbon::parse($bookingDTO->getCheckIn());
            $checkOut = Carbon::parse($bookingDTO->getCheckOut());

            $totalNights = $checkIn->diffInDays($checkOut);
            $totalPrice = $totalNights * $room->price_per_night;

            $booking->user_id = $bookingDTO->getUserId();
            $booking->room_id = $bookingDTO->getRoomId();
            $booking->check_in = $bookingDTO->getCheckIn();
            $booking->check_out = $bookingDTO->getCheckOut();
            $booking->total_price = $totalPrice;
            $booking->status = $bookingDTO->getStatus();
            return $this->repository->saveBooking($booking);

        } catch (\Exception $e) {
            throw new BusinessException(__('bookings.failed_to_update_booking'));
        }
    }

    public function rejectBooking(int $bookingId): void
    {
        $this->repository->cancelBooking($bookingId);
    }
}
