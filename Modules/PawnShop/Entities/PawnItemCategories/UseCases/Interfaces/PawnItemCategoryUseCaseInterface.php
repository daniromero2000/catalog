<?php

namespace Modules\PawnShop\Entities\PawnItemCategories\UseCases\Interfaces;

interface PawnItemCategoryUseCaseInterface
{
    public function listPawnItemCategories(array $data): array;

    public function createPawnItemCategory();

    public function storePawnItemCategory(array $requestData);

    public function updatePawnItemCategory($request, int $id);

    public function destroyPawnItemCategory(int $id);
}
