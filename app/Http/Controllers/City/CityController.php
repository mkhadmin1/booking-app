<?php

namespace App\Http\Controllers\City;


use App\Exceptions\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\City\StoreCityRequest;
use App\Models\City;
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

     * @param CityService $service
     * @return JsonResponse
     */
    public function store(StoreCityRequest $request, CityService $service)
    {
        $service->execute($request->name);
        return response()->json(['message' => __('cities.city_created_success')]);
    }

    /**
     * @param int $cityId
     * @param CityService $service
     * @return City|null
     * @throws ModelNotFoundException
     */
    public function show(int $cityId, CityService $service)
    {
        return $service->getCity($cityId);
    }


}
