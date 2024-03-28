<?php

namespace App\Http\Controllers\Room;

use App\DTO\RoomDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Services\RoomService;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    /**
     * @param RoomService $service
     * @return JsonResponse
     */
    public function index(RoomService $service): JsonResponse
    {
        return $service->getAllRooms();
    }

    /**
     * @param StoreRoomRequest $request
     * @param RoomService $service
     * @return JsonResponse
     */
    public function store(StoreRoomRequest $request, RoomService $service): JsonResponse
    {
        $roomDTO = $request->validated();
        $service->createRoom(RoomDTO::fromArray($roomDTO));
        return response()->json(['message' => __('rooms.room_created_success')], 201);
    }

    /**
     * @param int $roomId
     * @param RoomService $service
     * @return RoomResource
     */
    public function show(int $roomId, RoomService $service): RoomResource
    {
        return $service->getRoom($roomId);
    }

    /**
     * @param UpdateRoomRequest $request
     * @param int $roomId
     * @param RoomService $service
     * @return JsonResponse
     */
    public function update(UpdateRoomRequest $request, int $roomId, RoomService $service): JsonResponse
    {
        $roomDTO = $request->validated();
        $service->updateRoom(RoomDTO::fromArray($roomDTO), $roomId);
        return response()->json(['message' => __('rooms.room_update_success')], 201);
    }

    /**
     * @param RoomService $service
     * @param int $roomId
     * @return JsonResponse
     */
    public function destroy(RoomService $service, int $roomId): JsonResponse
    {
        $service->deleteRoom($roomId);
        return response()->json(['message' => __('rooms.room_deleted_success')], 201);
    }
}
