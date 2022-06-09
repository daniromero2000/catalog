<?php

namespace Modules\CamStudio\Entities\Fouls\UseCases\Interfaces;

interface FoulUseCaseInterface
{
    public function listFouls(array $data): array;

    public function createFoul();

    public function storeFoul(array $requestData);

    public function updateFoul($request, int $id);

    public function destroyFoul(int $id);
}
