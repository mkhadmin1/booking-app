<?php

namespace App\Http\Controllers;

use App\DTO\HotelDTO;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Http\Resources\FeedbackResource;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param HotelService $service
     * @return JsonResponse
     */
    public function index(HotelService $service)
    {
        return $service->getAllHotels();
    }

    /**
     * Display the specified resource.
     *
     * @param int $hotelId
     * @param HotelService $service
     * @return Hotel
     */
    public function show(int $hotelId, HotelService $service): Hotel
    {
        return $service->getHotelById($hotelId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHotelRequest $request
     * @param HotelService $service
     * @return JsonResponse
     */
    public function store(StoreHotelRequest $request, HotelService $service)
    {
        $hotelDTO = $request->validated();
        $service->createHotel(HotelDTO::fromArray($hotelDTO));
        return response()->json(['message' => __('hotels.hotel_created_success')], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateHotelRequest $request
     * @param int $hotelId
     * @param HotelService $service
     * @return JsonResponse
     */
    public function update(UpdateHotelRequest $request, int $hotelId, HotelService $service): JsonResponse
    {
        $hotel = Hotel::query()->find($hotelId);

        if (!$hotel) {
            return response()->json(['message' => __('hotels.hotel_not_found')]);
        }
        $service->updateHotel(HotelDTO::fromArray($request->validated()), $hotelId);
        return response()->json(['message' => __('hotels.hotel_updated_success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $hotelId
     * @param HotelService $service
     * @return JsonResponse
     */
    public function destroy(int $hotelId, HotelService $service): JsonResponse
    {
        $hotel = Hotel::query()->find($hotelId);

        if (!$hotel) {
            return response()->json(['message' => __('hotels.hotel_not_found')]);
        }
        $service->destroyHotel($hotelId);
        return response()->json(['message' => __('hotels.hotel_deleted_success')]);
    }

    public function showHotelFeedbacks(HotelService $service,int $hotelId)
    {
        $hotel = Hotel::query()->find($hotelId);

        if (!$hotel) {
            return response()->json(['message' => __('hotels.hotel_not_found')]);
        }
        return $service->getHotelFeedbacks($hotelId);


    }

    public function availableRooms(HotelService $service, int $hotelId): JsonResponse
    {
        $hotel = Hotel::query()->find($hotelId);

        if (!$hotel) {
            return response()->json(['message' => __('hotels.hotel_not_found')]);
        }

        $rooms = $service->getAvailableRooms($hotelId);

        return response()->json($rooms);
    }



}
