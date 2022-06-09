<?php

namespace Modules\PawnShop\Entities\PawnItemStatuses\Repositories\Interfaces;

use Modules\PawnShop\Entities\PawnItemStatuses\PawnItemStatus;
use Illuminate\Support\Collection;

interface PawnItemStatusRepositoryInterface
{
    public function createPawnItemStatus(array $data): PawnItemStatus;

    public function updatePawnItemStatus(array $data): bool;

    public function findPawnItemStatusById(int $id): PawnItemStatus;

    public function listPawnItemStatuses($totalView): Collection;

    public function deletePawnItemStatus(): bool;

    public function searchPawnItemStatus(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countPawnItemStatus(string $text = null,  $from = null, $to = null);

    public function getAllPawnItemStatusesNames(): Collection;
}
