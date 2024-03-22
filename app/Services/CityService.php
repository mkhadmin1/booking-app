<?php

namespace App\Services;

use App\Contracts\ICityRepository;
use App\DTO\CityDTO;
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

    public function getCity(int $cityId): ?City
    {
        return $this->repository->getCityById($cityId);
    }

    public function execute(CityDTO $cityDTO): City
    {
        return $this->repository->createCity($cityDTO);
    }

    public function update(CityDTO $cityDTO, int $cityId): City
    {
        return $this->repository->updateCity($cityDTO, $cityId);
    }

    public function destroy(int $cityId)
    {
        return $this->repository->destroyCity($cityId);
    }

    public function getCityHotels(int $cityId)
    {
        return $this->repository->getCityHotels($cityId);
    }
}
