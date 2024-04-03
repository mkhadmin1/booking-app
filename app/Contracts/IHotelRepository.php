<?php

namespace App\Contracts;

use App\DTO\HotelDTO;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;

interface IHotelRepository
{
    public function getHotels(): JsonResponse;

    public function getHotelById(int $hotelId);


    public function saveHotel(Hotel $hotel);

    public function destroyHotel(Hotel $hotel);
}
