<?php

namespace App\Http\Controllers\Booking;

use App\DTO\BookingDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * @param BookingService $service
     * @return JsonResponse
     */
    public function index(BookingService $service): JsonResponse
    {
        return $service->getAllBookings();
    }

    /**
     * @param int $bookingId
     * @param BookingService $service
     * @return Booking
     */
    public function show(int $bookingId, BookingService $service): Booking
    {
        return $service->getBookingById($bookingId);
    }

    /**
     * @param StoreBookingRequest $request
     * @param BookingService $service
     * @return JsonResponse
     */
    public function store(StoreBookingRequest $request, BookingService $service)
    {
        $bookingDTO = $request->validated();
        $service->createBooking(BookingDTO::fromArray($bookingDTO));
        return response()->json(['message' => __('bookings.booking_created_success')], 201);
    }

    /**
     * @param UpdateBookingRequest $request
     * @param int $bookingId
     * @param BookingService $service
     * @return JsonResponse
     */
    public function update(UpdateBookingRequest $request, int $bookingId, BookingService $service): JsonResponse
    {
        $service->updateBooking(BookingDTO::fromArray($request->validated()), $bookingId);
        return response()->json(['message' => __('bookings.booking_updated_success')]);
    }

    /**
     * @param int $bookingId
     * @param BookingService $service
     * @return JsonResponse
     */
    public function destroy(int $bookingId, BookingService $service): JsonResponse
    {
        $service->destroyBooking($bookingId);
        return response()->json(['message' => __('bookings.booking_deleted_success')]);
    }
}
