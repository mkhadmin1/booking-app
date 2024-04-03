<?php

namespace App\Contracts;


use App\Models\City;
use Illuminate\Http\JsonResponse;

interface ICityRepository
{

    /**
     * @param int $cityId
     * @return City|null
     */
    public function getCityById(int $cityId): ?City;

    /**
     * @param string $name
     * @return City
     */
    public function createCity(string $name);

}
