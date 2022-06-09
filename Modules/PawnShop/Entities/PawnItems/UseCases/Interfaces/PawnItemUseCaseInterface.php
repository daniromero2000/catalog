<?php

namespace Modules\PawnShop\Entities\PawnItems\UseCases\Interfaces;

interface PawnItemUseCaseInterface
{
    public function listPawnItems(array $data): array;

    public function createPawnItem();

    public function storePawnItem(array $requestData);

    public function updatePawnItem(array $request, int $id);

    public function destroyPawnItem(int $id);
}
