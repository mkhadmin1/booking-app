<?php

namespace App\Services;

use App\Contracts\ICityRepository;
use App\DTO\CityDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelAlreadyExistsException;
use App\Exceptions\ModelNotFoundException;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityService
{
    private ICityRepository $repository;

    public function __construct(ICityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCities(): JsonResponse
    {
        return $this->repository->getCities();
    }

    public function getCity(int $cityId): City|null
    {
        $city = $this->repository->getCityById($cityId);
        if (!$city) {
            throw new ModelNotFoundException(__('cities.city_not_found'), 404);
        }
        return $city;
    }

    public function execute(string $name)
    {
        $existingCity = $this->repository->createCity($name);
        if ($existingCity) {
            throw new ModelAlreadyExistsException(__('cities.city_exists'));
        }
        $city = new City();
        $city->name = $name;
        return $city->save();
    }


}
