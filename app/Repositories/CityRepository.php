<?php

namespace App\Repositories;

use App\Contracts\ICityRepository;
use App\DTO\CityDTO;
use App\Exceptions\CityNotFoundException;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Http\Resources\CityResource;
use App\Http\Resources\HotelResource;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityRepository implements ICityRepository
{
    public function getCities(): JsonResponse
    {
        $cities = City::all();
        return response()->json(['data' => $cities]);
    }

    /**
     * @param int $cityId
     * @return City|null
     * @throws ModelNotFoundException
     */
    public function getCityById(int $cityId): ?City
    {
        $city = City::find($cityId);
        if (!$city) {
            throw new ModelNotFoundException(__('cities.city_not_found'), 404);
        }
        return $city;
    }

    /**
     * @param CityDTO $cityDTO
     * @return City
     */
    public function createCity(CityDTO $cityDTO): City
    {
        try {

            $city = new City();
            $city->name = $cityDTO->getName();
            $city->save();
            return $city;

        } catch (\Exception $e) {
            throw new BusinessException(__('cities.failed_to_create_city'));
        }
    }

    public function updateCity(CityDTO $cityDTO, int $id): City
    {
        $city = City::find($id);
        if (!$city) {
            throw new ModelNotFoundException(__('cities.city_not_found'));
        }

        try {

            $city->name = $cityDTO->getName();
            $city->update();
            return $city;

        } catch (\Exception $e) {
            throw new BusinessException(__('cities.failed_to_create_city'));
        }
    }

    /**
     * @param int $cityId
     * @throws ModelNotFoundException
     */
    public function destroyCity(int $cityId)
    {
        $city = City::find($cityId);
        if (!$city) {
            throw new ModelNotFoundException(__('cities.city_not_found'));
        }

        $city->delete();
    }

    /**
     * @param int $cityId
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function getCityHotels(int $cityId): JsonResponse
    {
        $city = City::find($cityId);
        if (!$city) {
            throw new ModelNotFoundException(__('cities.city_not_found'),);
        }

        return HotelResource::collection($city->hotels);
    }
}
