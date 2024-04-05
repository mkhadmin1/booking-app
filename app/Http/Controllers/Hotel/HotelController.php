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
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'per_page' => 'required|int',
            'q' => 'nullable|string'
        ]);

        $hotels = Hotel::query();

        if ($request->query('q') != null) {
            $hotels->where('name', '=', $request->query('q'));
        }

        $hotels = $hotels->paginate($request->query('per_page'));

        return response()->json(['data' => $hotels]);
    }

    /**
     * @throws ModelNotFoundException
     */
    public function show(int $hotelId, HotelService $service)
    {
        return $service->getHotel($hotelId);
    }

    public function store(StoreHotelRequest $request, HotelService $service)
    {
        $hotelDTO = $request->validated();
        $service->createHotel(HotelDTO::fromArray($hotelDTO));
        return response()->json(['message' => __('hotels.hotel_created_success')], 201);
    }

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
