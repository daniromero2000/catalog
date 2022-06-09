<?php

namespace Modules\PawnShop\Entities\PawnItemCategories\Repositories\Interfaces;

use Modules\PawnShop\Entities\PawnItemCategories\PawnItemCategory;

interface PawnItemCategoryRepositoryInterface
{
    public function createPawnItemCategory(array $data): PawnItemCategory;

    public function updatePawnItemCategory(array $data): bool;

    public function findPawnItemCategoryById(int $id): PawnItemCategory;

    public function deletePawnItemCategory(): bool;

    public function searchPawnItemCategory(string $text = null);

    public function getAllPawnItemCategoryNames();
}
