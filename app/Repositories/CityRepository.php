<?php

namespace App\Repositories;

use App\Contracts\ICityRepository;
use App\DTO\CityDTO;
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

    public function getCityById(int $cityId): ?City
    {
        return City::query()->find($cityId);
    }

    public function createCity(CityDTO $cityDTO): City
    {
        $city = new City();
        $city->name = $cityDTO->getName();
        $city->save();
        return $city;
    }

    public function updateCity(CityDTO $cityDTO, int $id): City
    {
        $city = City::find($id);
        $city->name = $cityDTO->getName();
        $city->update();
        return $city;
    }

    public function destroyCity(int $cityId)
    {
        $city = City::find($cityId);
        $city->delete();
    }

    /**
     * @param int $cityId
     */
    public function getCityHotels(int $cityId)
    {
        $city = City::query()->find($cityId);
        if (!$city) {
            return response()->json(['message' => 'City not found'], 404);
        }

        return HotelResource::collection($city->hotels);
    }
}
