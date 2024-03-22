<?php

namespace App\Services;

use App\Contracts\IHotelRepository;
use App\DTO\HotelDTO;
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

    public function getHotelById(int $hotelId): ?Hotel
    {
        return $this->repository->getHotelById($hotelId);
    }

    public function createHotel(HotelDTO $hotelDTO): Hotel
    {
        return $this->repository->createHotel($hotelDTO);
    }

    public function updateHotel(HotelDTO $hotelDTO, int $hotelId): Hotel
    {
        return $this->repository->updateHotel($hotelDTO, $hotelId);
    }

    public function destroyHotel(int $hotelId)
    {
        $this->repository->destroyHotel($hotelId);
    }

    public function getHotelFeedbacks(int $hotelId)
    {
        return $this->repository->getHotelFeedbacks($hotelId);

    }
}
