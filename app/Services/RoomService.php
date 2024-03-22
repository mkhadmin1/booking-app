<?php

namespace App\Services;

use App\Contracts\IRoomRepository;
use App\DTO\RoomDTO;
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

    public function getAllRooms(): JsonResponse
    {
        return $this->repository->getRooms();
    }

    public function getRoom(int $roomId): RoomResource
    {
        return $this->repository->getRoomById($roomId);
    }

    public function createRoom(RoomDTO $roomDTO): RoomResource
    {
        return $this->repository->createRoom($roomDTO);
    }

    public function updateRoom(RoomDTO $roomDTO, int $roomId)
    {
        return $this->repository->updateRoom($roomId, $roomDTO);
    }

    public function deleteRoom(int $roomId): void
    {
        $this->repository->destroyRoom($roomId);
    }
}

