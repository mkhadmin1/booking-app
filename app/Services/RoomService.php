<?php

namespace App\Services;

use App\Contracts\IRoomRepository;
use App\DTO\RoomDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\JsonResponse;

class RoomService
{
    private IRoomRepository $repository;

    public function __construct(IRoomRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getRoom(int $roomId)
    {
       $room = $this->repository->getRoomById($roomId);
        if (!$room) {
            throw new ModelNotFoundException(__('rooms.room_not_found'));
        }
        return new RoomResource($room);
    }

    public function createRoom(RoomDTO $roomDTO)
    {

        try {
            $room = new Room();
            $room->hotel_id = $roomDTO->getHotelId();
            $room->room_number = $roomDTO->getRoomNumber();
            $room->type = $roomDTO->getType();
            $room->capacity = $roomDTO->getCapacity();
            $room->price_per_night = $roomDTO->getPricePerNight();

            return $this->repository->saveRoom($room);

        } catch (\Exception $e) {
            throw new BusinessException(__('rooms.failed_to_create_room'));
        }
    }

    public function updateRoom(RoomDTO $roomDTO, int $roomId)
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

            return $this->repository->saveRoom($room);

        } catch (\Exception $e) {
            throw new BusinessException(__('rooms.failed_to_update_room'));
        }
    }

    public function deleteRoom(int $roomId)
    {
        $room = Room::query()->find($roomId);
        if (!$room) {
            throw new ModelNotFoundException(__('rooms.room_not_found'));
        }
        return $this->repository->destroyRoom($room);
    }
}

