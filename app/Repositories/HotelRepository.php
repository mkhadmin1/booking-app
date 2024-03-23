<?php

namespace App\Repositories;

use App\Contracts\IHotelRepository;
use App\DTO\HotelDTO;
use App\Http\Resources\FeedbackResource;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\JsonResponse;

class HotelRepository implements IHotelRepository
{
    public function getHotels(): JsonResponse
    {
        /** @var array $hotels */
        $hotels = Hotel::all();

        return response()->json([
            'data' => $hotels
        ]);
    }

    public function getHotelById(int $hotelId): ?Hotel
    {
        /** @var Hotel|null $hotel */
        $hotel = Hotel::query()->find($hotelId);
        return $hotel;
    }

    public function createHotel(HotelDTO $hotelDTO): Hotel
    {
        $hotel = new Hotel();
        $hotel->name = $hotelDTO->getName();
        $hotel->description = $hotelDTO->getDescription();
        $hotel->address = $hotelDTO->getAddress();
        $hotel->phone = $hotelDTO->getPhone();
        $hotel->email = $hotelDTO->getEmail();
        $hotel->city_id = $hotelDTO->getCityId();
        $hotel->rating = $hotelDTO->getRating();
        $hotel->manager_id = $hotelDTO->getManagerId();
        $hotel->save();
        return $hotel;
    }

    public function updateHotel(HotelDTO $hotelDTO, int $hotelId): Hotel
    {
        /** @var Hotel $hotel */
        $hotel = Hotel::query()->find($hotelId);
        $hotel->name = $hotelDTO->getName();
        $hotel->description = $hotelDTO->getDescription();
        $hotel->address = $hotelDTO->getAddress();
        $hotel->phone = $hotelDTO->getPhone();
        $hotel->email = $hotelDTO->getEmail();
        $hotel->city_id = $hotelDTO->getCityId();
        $hotel->rating = $hotelDTO->getRating();
        $hotel->manager_id = $hotelDTO->getManagerId();
        $hotel->save();
        return $hotel;
    }

    public function destroyHotel(int $hotelId)
    {
        $hotel = Hotel::query()->find($hotelId);
        $hotel->delete();
    }



    public function getHotelFeedbacks(int $hotelId)
    {
        $hotel = Hotel::query()->find($hotelId);
        if (!$hotel) {
            return response()->json(['message' => __('hotels.hotel_not_found')]);
        }

        $feedbacks = $hotel->feedbacks;
        if ($feedbacks === null) {
            return response()->json(['message' => __('hotels.no_feedbacks_available')]);
        }

        return FeedbackResource::collection($hotel->feedbacks);
    }

    public function getAvailableRooms(int $hotelId)
    {
        return Hotel::query()->findOrFail($hotelId)
            ->rooms()
            ->where('is_available', 1)
            ->get();
    }

}
