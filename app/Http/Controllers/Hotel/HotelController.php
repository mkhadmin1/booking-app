<?php

namespace App\Http\Controllers\Hotel;

use App\DTO\HotelDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
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
    public function show(int $hotelId, HotelService $service)
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
     * @throws BusinessException
     * @throws ModelNotFoundException
     */
    public function update(UpdateHotelRequest $request, int $hotelId, HotelService $service): JsonResponse
    {
        $service->updateHotel(HotelDTO::fromArray($request->validated()), $hotelId);
        return response()->json(['message' => __('hotels.hotel_updated_success')]);
    }


    public function destroy(int $hotelId, HotelService $service): JsonResponse
    {
        $service->deleteHotel($hotelId);
        return response()->json(['message' => __('hotels.hotel_deleted_success')]);
    }

}
