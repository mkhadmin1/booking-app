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
    /**
     * @return JsonResponse
     */
    public function getRooms(): JsonResponse
    {
        $rooms = Room::all();
        return response()->json(['data' => $rooms]);
    }

    /**
     * @param int $roomId
     * @return RoomResource
     * @throws ModelNotFoundException
     */
    public function getRoomById(int $roomId): RoomResource
    {
        $room = Room::query()->find($roomId);
        if (!$room) {
            throw new ModelNotFoundException(__('rooms.room_not_found'));
        }
        return new RoomResource($room);
    }

    /**
     * Создает новую комнату.
     *
     * @param RoomDTO $roomDTO
     * @return RoomResource
     * @throws BusinessException
     */
    public function createRoom(RoomDTO $roomDTO): RoomResource
    {
        try {
            $room = new Room();
            $room->hotel_id = $roomDTO->getHotelId();
            $room->room_number = $roomDTO->getRoomNumber();
            $room->type = $roomDTO->getType();
            $room->capacity = $roomDTO->getCapacity();
            $room->price_per_night = $roomDTO->getPricePerNight();

            $room->save();
            return new RoomResource($room);
        } catch (\Exception $e) {
            throw new BusinessException(__('rooms.failed_to_create_room'));
        }
    }

    /**
     * @param int $roomId
     * @param RoomDTO $roomDTO
     * @return Room
     * @throws BusinessException
     * @throws ModelNotFoundException
     */
    public function updateRoom(int $roomId, RoomDTO $roomDTO)
    {
        $room = Room::find($roomId);
        if (!$room) {
            throw new ModelNotFoundException(__('rooms.room_not_found'));
        }

        try {
            $room->hotel_id = $roomDTO->getHotelId();
            $room->room_number = $roomDTO->getRoomNumber();
            $room->type = $roomDTO->getType();
            $room->capacity = $roomDTO->getCapacity();
            $room->price_per_night = $roomDTO->getPricePerNight();
            $room->save();
            return $room;
        } catch (\Exception $e) {
            throw new BusinessException(__('rooms.failed_to_update_room'));
        }
    }

    /**
     * @param int $roomId
     * @return void
     * @throws ModelNotFoundException
     */
    public function destroyRoom(int $roomId): void
    {
        $room = Room::query()->find($roomId);
        if (!$room) {
            throw new ModelNotFoundException(__('rooms.room_not_found'));
        }
        $room->delete();
    }
}
