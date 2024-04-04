<?php

namespace App\Contracts;

use App\DTO\HotelDTO;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;

interface IHotelRepository
{
    public function getHotelById(int $hotelId): Hotel|null;

    public function saveHotel(Hotel $hotel);

    public function destroyHotel(Hotel $hotel);
}
