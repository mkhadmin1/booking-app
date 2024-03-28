<?php

namespace App\Http\Controllers\Hotel;

use App\DTO\HotelDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreHotelRequest;
use App\Http\Requests\Hotel\UpdateHotelRequest;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    /**
     * @param HotelService $service
     * @return JsonResponse
     */
    public function index(HotelService $service)
    {
        return $service->getAllHotels();
    }

    /**
     * @param int $hotelId
     * @param HotelService $service
     * @return Hotel
     */
    public function show(int $hotelId, HotelService $service): Hotel
    {
        return $service->getHotelById($hotelId);
    }

    /**
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
     * @param UpdateHotelRequest $request
     * @param int $hotelId
     * @param HotelService $service
     * @return JsonResponse
     */
    public function update(UpdateHotelRequest $request, int $hotelId, HotelService $service): JsonResponse
    {
        $service->updateHotel(HotelDTO::fromArray($request->validated()), $hotelId);
        return response()->json(['message' => __('hotels.hotel_updated_success')]);
    }

    /**
     * @param int $hotelId
     * @param HotelService $service
     * @return JsonResponse
     */
    public function destroy(int $hotelId, HotelService $service): JsonResponse
    {
        $service->destroyHotel($hotelId);
        return response()->json(['message' => __('hotels.hotel_deleted_success')]);
    }

    /**
     * @param HotelService $service
     * @param int $hotelId
     * @return mixed
     */
    public function showHotelFeedbacks(HotelService $service, int $hotelId)
    {
        return $service->getHotelFeedbacks($hotelId);
    }

    /**
     * @param HotelService $service
     * @param int $hotelId
     * @return JsonResponse
     */
    public function getAvailableRooms(HotelService $service, int $hotelId): JsonResponse
    {
        $rooms = $service->getAvailableRooms($hotelId);
        return response()->json($rooms);
    }
}
