<?php

namespace App\Contracts;

use App\DTO\RoomDTO;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

interface IRoomRepository
{

    public function getRoomById(int $roomId);

    public function saveRoom(Room $room);

    public function destroyRoom(Room $room);
}
