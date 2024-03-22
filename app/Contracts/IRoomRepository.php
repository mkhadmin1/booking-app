<?php

namespace App\Contracts;

use App\DTO\RoomDTO;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

interface IRoomRepository
{

    public function getRooms(): JsonResponse;

    public function getRoomById(int $roomId): ?RoomResource;

    public function createRoom(RoomDTO $roomDTO): ?RoomResource;

    public function updateRoom(int $roomId, RoomDTO $roomDTO);

    public function destroyRoom(int $roomId);
}
