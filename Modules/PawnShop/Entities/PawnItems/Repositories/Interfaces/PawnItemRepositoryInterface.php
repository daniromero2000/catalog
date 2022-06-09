<?php

namespace Modules\PawnShop\Entities\PawnItems\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\PawnShop\Entities\PawnItems\PawnItem;

interface PawnItemRepositoryInterface
{
    public function createPawnItem(array $data): PawnItem;

    public function updatePawnItem(array $data): bool;

    public function findPawnItemById(int $id): PawnItem;

    public function listPawnItems(int $totalView): Collection;

    public function countPawnItem(string $text = null,  $from = null, $to = null): int;

    public function deletePawnItem(): bool;

    public function searchPawnItem(string $text = null, int $totalView, $from = null, $to = null): Collection;
}
