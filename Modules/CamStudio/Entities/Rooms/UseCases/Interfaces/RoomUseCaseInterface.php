<?php

namespace Modules\CamStudio\Entities\Rooms\UseCases\Interfaces;

use Modules\CamStudio\Entities\Rooms\Room;

interface RoomUseCaseInterface
{
    public function listRooms(array $data): array;

    public function createRoom(): array;

    public function storeRoom(array $requestData): Room;

    public function updateRoom($request, int $id): bool;

    public function destroyRoom(int $id);
}
