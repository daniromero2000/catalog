<?php

namespace Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces;

use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;
use Illuminate\Support\Collection;

interface CammodelCategoryRepositoryInterface
{
    //public function searchCammodelCategories(string $text = null): Collection;

    public function findCammodelCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection;

    public function createCammodelCategory(array $data): CammodelCategory;

    public function updateCammodelCategory(array $data): CammodelCategory;

    public function findCammodelCategoryById(int $id): CammodelCategory;

    public function deleteCammodelCategory(): bool;

    public function updateSortOrder(array $data);

    public function countCammodels();

    public function deleteFile(array $file, $disk = null): bool;

    public function findCammodelCategoryBySlug(array $slug): CammodelCategory;

    public function searchCammodelCategories(string $text = null);

    public function listCammodelCategories();
}
