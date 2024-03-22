<?php

namespace App\Http\Controllers;

use App\DTO\RoomDTO;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Services\RoomService;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoomService $service): JsonResponse
    {
        return $service->getAllRooms();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request, RoomService $service)
    {
        $roomDTO = $request->validated();
        $service->createRoom(RoomDTO::fromArray($roomDTO));
        return response()->json(['message' => 'Room created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $roomId, RoomService $service): RoomResource
    {
        $room = $service->getRoom($roomId);
        return new RoomResource($room);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, int $roomId, RoomService $service)
    {
        $roomDTO = $request->validated();
        $service->updateRoom(RoomDTO::fromArray($roomDTO), $roomId);
        return response()->json(['message' => 'Room updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomService $service, int $roomId)
    {
        $service->deleteRoom($roomId);
        return response()->json(['message' => 'Room deleted successfully']);
    }
}
