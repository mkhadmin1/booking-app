<?php

namespace App\Repositories;

use App\Contracts\IRoomRepository;
use App\DTO\RoomDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

class RoomRepository implements IRoomRepository
{


    public function getRoomById(int $roomId)
    {
        $room = Room::query()->find($roomId);
        return $room;
    }


    public function saveRoom(Room $room)
    {
        $room->save();
    }



    public function destroyRoom(Room $room)
    {

        return $room->delete();
    }
}
