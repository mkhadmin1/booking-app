<?php

namespace App\Http\Controllers;

use App\DTO\CityDTO;
use App\Http\Resources\CityResource;
use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CityService $service): JsonResponse
    {
        return $service->getAllCities();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request, CityService $service)
    {
        $cityDTO = $request->validated();
        $service->execute(CityDTO::fromArray($cityDTO));
        return response()->json(['message' => 'City created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $cityId, CityService $service)
    {
        $city = $service->getCity($cityId);
        return new CityResource($city);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, int $cityId, CityService $service)
    {
        $cityDTO = $request->validated();
        $service->update(CityDTO::fromArray($cityDTO), $cityId);
        return response()->json(['message' => 'City updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CityService $service, int $cityId)
    {
        $service->destroy($cityId);
        return response()->json(['message' => 'City deleted successfully']);
    }

    public function showCityHotels(CityService $service, int $cityId)
    {
        return $service->getCityHotels($cityId);
    }
}
