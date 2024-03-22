<?php

namespace App\Services;

use App\Contracts\IBookingRepository;
use App\DTO\BookingDTO;
use App\Models\Booking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\BookingsResource;

class BookingService
{
    private IBookingRepository $repository;

    public function __construct(IBookingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllBookings()
    {
        return $this->repository->getBookings();

    }
    public function getBookingById(int $bookingId): ?Booking
    {
        return $this->repository->getBookingById($bookingId);
    }

    public function createBooking(BookingDTO $bookingDTO): Booking
    {
        return $this->repository->createBooking($bookingDTO);
    }

    public function updateBooking(BookingDTO $bookingDTO, int $bookingId): Booking
    {
        return $this->repository->updateBooking($bookingDTO, $bookingId);
    }

    public function destroyBooking(int $bookingId)
    {
        $this->repository->destroyBooking($bookingId);
    }
}
