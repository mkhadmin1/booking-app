<?php

namespace App\Repositories;

use App\Contracts\IHotelRepository;
use App\DTO\HotelDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Http\Resources\FeedbackResource;
use App\Models\Hotel;
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

    /**
     * @param int $hotelId
     * @return Hotel|null
     * @throws ModelNotFoundException
     */
    public function getHotelById(int $hotelId): ?Hotel
    {
        $hotel = Hotel::query()->find($hotelId);
        if (!$hotel) {
            throw new ModelNotFoundException(__('hotels.hotel_not_found'));
        }
        return $hotel;
    }

    /**
     * Создает новый отель.
     *
     * @param HotelDTO $hotelDTO
     * @return Hotel
     * @throws BusinessException
     */
    public function createHotel(HotelDTO $hotelDTO): Hotel
    {
        try {
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
        } catch (\Exception $e) {
            throw new BusinessException(__('hotels.failed_to_create_hotel'));
        }
    }

    /**
     * @param HotelDTO $hotelDTO
     * @param int $hotelId
     * @return Hotel
     * @throws BusinessException
     * @throws ModelNotFoundException
     */
    public function updateHotel(HotelDTO $hotelDTO, int $hotelId): Hotel
    {
        $hotel = Hotel::query()->find($hotelId);
        if (!$hotel) {
            throw new ModelNotFoundException(__('hotels.hotel_not_found'));
        }

        try {
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
        } catch (\Exception $e) {
            throw new BusinessException(__('hotels.failed_to_create_hotel'));
        }
    }

    /**
     * @param int $hotelId
     * @return void
     * @throws ModelNotFoundException
     */
    public function destroyHotel(int $hotelId)
    {
        $hotel = Hotel::query()->find($hotelId);
        if (!$hotel) {
            throw new ModelNotFoundException(__('hotels.hotel_not_found'));
        }
        $hotel->delete();
    }

    /**
     * @param int $hotelId
     * @return FeedbackResource
     * @throws ModelNotFoundException
     */
    public function getHotelFeedbacks(int $hotelId)
    {
        $hotel = Hotel::query()->find($hotelId);
        if (!$hotel) {
            throw new ModelNotFoundException(__('hotels.hotel_not_found'));
        }

        $feedbacks = $hotel->feedbacks;
        if ($feedbacks === null) {
            throw new ModelNotFoundException(__('hotels.no_feedbacks_available'));
        }

        return FeedbackResource::collection($hotel->feedbacks);
    }

    /**
     * @param int $hotelId
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getAvailableRooms(int $hotelId)
    {
        $hotel = Hotel::query()->find($hotelId);
        if (!$hotel) {
            throw new ModelNotFoundException(__('hotels.hotel_not_found'));
        }
        return $hotel->rooms()->where('is_available', 1)->get();
    }
}
