<?php

namespace App\Http\Controllers;

use App\DTO\BookingDTO;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param BookingService $service
     * @return JsonResponse
     */
    public function index(BookingService $service)
    {
        return $service->getAllBookings();
    }

    /**
     * Display the specified resource.
     *
     * @param int $bookingId
     * @param BookingService $service
     * @return Booking
     */
    public function show(int $bookingId, BookingService $service): Booking
    {
        return $service->getBookingById($bookingId);
    }

    /**
     * Store a newly created resource in storage.
     *
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
     * Update the specified resource in storage.
     *
     * @param UpdateBookingRequest $request
     * @param int $bookingId
     * @param BookingService $service
     * @return JsonResponse
     */
    public function update(UpdateBookingRequest $request, int $bookingId, BookingService $service): JsonResponse
    {
        $booking = Booking::query()->find($bookingId);

        if (!$booking) {
            return response()->json(['message' => __('bookings.booking_not_found')]);
        }
        $service->updateBooking(BookingDTO::fromArray($request->validated()), $bookingId);
        return response()->json(['message' => __('bookings.booking_updated_success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $bookingId
     * @param BookingService $service
     * @return JsonResponse
     */
    public function destroy(int $bookingId, BookingService $service): JsonResponse
    {
        $booking = Booking::query()->find($bookingId);

        if (!$booking) {
            return response()->json(['message' => __('bookings.booking_not_found')]);
        }
        $service->destroyBooking($bookingId);
        return response()->json(['message' => __('bookings.booking_deleted_success')]);
    }
}
