<?php

namespace Modules\PawnShop\Entities\PawnItemStatuses\UseCases\Interfaces;

interface PawnItemStatusUseCaseInterface
{
    public function listPawnItemStatuses(array $data): array;

    public function createPawnItemStatus();

    public function storePawnItemStatus($requestData);

    public function updatePawnItemStatus($request, int $id);

    public function destroyPawnItemStatus(int $id);
}
