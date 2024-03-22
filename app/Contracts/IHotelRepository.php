<?php

namespace App\Contracts;

use App\DTO\HotelDTO;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;

interface IHotelRepository
{
    /**@return JsonResponse */
    public function getHotels(): JsonResponse;

    /**
     * Get hotel by ID.
     *
     * @param int $hotelId
     * @return Hotel|null
     */
    public function getHotelById(int $hotelId): ?Hotel;

    /**
     * Create a new hotel.
     *
     * @param HotelDTO $hotelDTO
     * @return Hotel
     */
    public function createHotel(HotelDTO $hotelDTO): Hotel;

    /**
     * Update an existing hotel.
     *
     * @param HotelDTO $hotelDTO
     * @param int $hotelId
     * @return Hotel
     */
    public function updateHotel(HotelDTO $hotelDTO, int $hotelId): Hotel;

    /**
     * Delete a hotel.
     *
     * @param int $hotelId
     * @return mixed
     */
    public function destroyHotel(int $hotelId);
    public function getHotelFeedbacks(int $hotelId);
}
