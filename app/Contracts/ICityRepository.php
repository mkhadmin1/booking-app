<?php

namespace App\Contracts;

use App\DTO\CityDTO;
use App\Models\City;
use Illuminate\Http\JsonResponse;

interface ICityRepository
{
    /**
     * @return JsonResponse
     */
    public function getCities(): JsonResponse;

    /**
     * @param int $cityId
     * @return City|null
     */
    public function getCityById(int $cityId): ?City;

    /**
     * @param CityDTO $cityDTO
     * @return City
     */
    public function createCity(CityDTO $cityDTO): City;

    /**
     * @param CityDTO $cityDTO
     * @param int $id
     * @return City
     */
    public function updateCity(CityDTO $cityDTO, int $id): City;

    /**
     * @param int $cityId
     * @return mixed
     */
    public function destroyCity(int $cityId);

    public function getCityHotels(int $city);
}
