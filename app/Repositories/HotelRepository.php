<?php

namespace App\Repositories;

use App\Contracts\IHotelRepository;
use App\DTO\HotelDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Http\Resources\FeedbackResource;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class HotelRepository implements IHotelRepository
{
    /**
     * @return JsonResponse
     */
    public function getHotels(): JsonResponse
    {
        $hotels = Hotel::all();
        return response()->json(['data' => $hotels]);
    }

    public function getHotelById(int $hotelId)
    {
        $hotel = Hotel::query()
            ->with(['feedbacks', 'rooms'])
            ->where('id', $hotelId)
            ->whereHas('rooms', function (Builder $query) {
                $query->where('is_available', 1);
            })
            ->first();

       return $hotel;
    }

    /**
     * @param HotelDTO $hotelDTO
     * @return Hotel
     * @throws BusinessException
     */
    public function saveHotel(Hotel $hotel)
    {
        $hotel->save();
        return $hotel;
    }

    /**
     * @param int $hotelId
     * @return void
     * @throws ModelNotFoundException
     */
    public function destroyHotel(Hotel $hotel)
    {
        return $hotel->delete();
    }

}
