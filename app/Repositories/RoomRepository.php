<?php

namespace App\Repositories;

use App\Contracts\IRoomRepository;
use App\DTO\RoomDTO;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

class RoomRepository implements IRoomRepository
{
    public function getRooms(): JsonResponse
    {
        $rooms = Room::all();
        return response()->json(['data' => $rooms]);
    }

    public function getRoomById(int $roomId): RoomResource
    {
        $room = Room::query()->find($roomId);
        return new RoomResource($room);
    }

    public function createRoom(RoomDTO $roomDTO): RoomResource
    {
        $room = new Room();
        $room->hotel_id = $roomDTO->getHotelId();
        $room->room_number = $roomDTO->getRoomNumber();
        $room->type = $roomDTO->getType();
        $room->capacity = $roomDTO->getCapacity();
        $room->price_per_night = $roomDTO->getPricePerNight();

        $room->save();
        return new RoomResource($room);
    }

    public function updateRoom(int $roomId, RoomDTO $roomDTO)
    {
        $room = Room::query()->find($roomId);

        $room->hotel_id = $roomDTO->getHotelId();
        $room->room_number = $roomDTO->getRoomNumber();
        $room->type = $roomDTO->getType();
        $room->capacity = $roomDTO->getCapacity();
        $room->price_per_night = $roomDTO->getPricePerNight();

        $room->save();
        return $room;

    }

    public function destroyRoom(int $roomId): void
    {
        $room = Room::query()->find($roomId);
        $room->delete();
    }
}
