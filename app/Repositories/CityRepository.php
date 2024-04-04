<?php

namespace App\Repositories;

use App\Contracts\ICityRepository;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityRepository implements ICityRepository
{

    /**
     * @param int $cityId
     * @return City|null
     */
    public function getCityById(int $cityId): City|null
    {
        /** @var City $city */
        $city = City::query()->with(['hotels'])->where('id', $cityId)->first();
     return $city;

    }


    public function createCity(string $name)
    {
        $city = City::where('name', $name)->first();
        return $city;

    }






}
