<?php

namespace Modules\CamStudio\Entities\CammodelCategories\UseCases\Interfaces;

interface CammodelCategoryUseCaseInterface
{
    public function listCammodelCategories(array $data): array;

    public function createCammodelCategory(): array;

    public function storeCammodelCategory(array $requestData): void;

    public function updateCammodelCategory($request, int $id): void;

    public function destroyCammodelCategory(int $id): void;
}
