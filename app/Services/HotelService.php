<?php

namespace App\Services;

use App\Contracts\IHotelRepository;
use App\DTO\HotelDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;

class HotelService
{
    private IHotelRepository $repository;

    public function __construct(IHotelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllHotels(): JsonResponse
    {
        return $this->repository->getHotels();
    }

    public function getHotelById(int $hotelId)
    {
        $hotel = $this->repository->getHotelById($hotelId);
        if (!$hotel) {
            throw new ModelNotFoundException(__('hotels.hotel_not_found'));
        }
        return $hotel;
    }

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
        $hotel->manage_id = $hotelDTO->getManagerId();
        return $this->repository->saveHotel($hotel);

    } catch (\Exception $e) {
        throw new BusinessException(__('hotels.failed_to_create_hotel'));
    }

    }

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
            return $this->repository->saveHotel($hotel);
        } catch (\Exception $e) {
            throw new BusinessException(__('hotels.failed_to_update_hotel'));
        }
    }

    public function deleteHotel(int $hotelId)
    {
        $hotel = Hotel::query()->find($hotelId);
        if (!$hotel) {
            throw new ModelNotFoundException(__('hotels.hotel_not_found'));
        }
        return $this->repository->destroyHotel($hotel);
    }

}
