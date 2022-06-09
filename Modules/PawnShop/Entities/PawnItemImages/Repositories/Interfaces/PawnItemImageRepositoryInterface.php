<?php

namespace Modules\PawnShop\Entities\PawnItemImages\Repositories\Interfaces;

use Modules\XisfoPay\Entities\PawnItemImages\PawnItemImage;

interface PawnItemImageRepositoryInterface
{
    public function createPawnItemImage(array $data): PawnItemImage;

    public function updatePawnItemImage(array $data): bool;

    public function findPawnItemImageById(int $id): PawnItemImage;

    public function deletePawnItemImage(): bool;
}
