<?php

namespace App\Http\Controllers\City;

use App\DTO\CityDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Resources\CityResource;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    /**
     * @param CityService $service
     * @return JsonResponse
     */
    public function index(CityService $service): JsonResponse
    {
        return $service->getAllCities();
    }

    /**
     * @param StoreCityRequest $request
     * @param CityService $service
     * @return JsonResponse
     */
    public function store(StoreCityRequest $request, CityService $service)
    {
        $cityDTO = $request->validated();
        $service->execute(CityDTO::fromArray($cityDTO));
        return response()->json(['message' => __('cities.city_created_success')]);
    }

    /**
     * @param int $cityId
     * @param CityService $service
     * @return CityResource
     */
    public function show(int $cityId, CityService $service): CityResource
    {
        return $service->getCity($cityId);
    }

    /**
     * @param UpdateCityRequest $request
     * @param int $cityId
     * @param CityService $service
     * @return JsonResponse
     */
    public function update(UpdateCityRequest $request, int $cityId, CityService $service): JsonResponse
    {
        $cityDTO = $request->validated();
        $service->update(CityDTO::fromArray($cityDTO), $cityId);
        return response()->json(['message' => __('cities.city_updated_success')]);
    }

    /**
     * @param CityService $service
     * @param int $cityId
     * @return JsonResponse
     */
    public function destroy(CityService $service, int $cityId): JsonResponse
    {
        $service->destroy($cityId);
        return response()->json(['message' => __('cities.city_deleted_success')]);
    }

    /**
     * @param CityService $service
     * @param int $cityId
     * @return mixed
     */
    public function showCityHotels(CityService $service, int $cityId)
    {
        return $service->getCityHotels($cityId);
    }
}
