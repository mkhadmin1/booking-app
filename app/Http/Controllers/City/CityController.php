<?php

namespace App\Http\Controllers\City;


use App\Exceptions\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\City\StoreCityRequest;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{

    public function index(Request $request)
    {
        $this->validate($request, [
            'per_page' => 'required|int',
            'q' => 'nullable|string'
        ]);

        $cities = Cache::remember('city_index', 300, function () use ($request) {
            $query = City::query();

            if ($request->query('q') != null) {
                $query->where('name', '=', $request->query('q'));
            }

            return $query->paginate($request->query('per_page'));
        });

        return response()->json(['data' => $cities]);
    }


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
