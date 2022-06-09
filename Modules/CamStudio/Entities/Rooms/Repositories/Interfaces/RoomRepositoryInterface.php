<?php

namespace Modules\CamStudio\Entities\Rooms\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\Rooms\Room;

interface RoomRepositoryInterface
{
    public function createRoom(array $data): Room;

    public function updateRoom(array $data): bool;

    public function findRoomById(int $roomId): Room;

    public function listRooms($totalView): Collection;

    public function deleteRoom(): bool;

    public function searchRoom(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countRoom(string $text = null,  $from = null, $to = null);

    public function saveRoomPhoto(UploadedFile $file, $room): string;

    public function getAllRoomNames(): Collection;
}
