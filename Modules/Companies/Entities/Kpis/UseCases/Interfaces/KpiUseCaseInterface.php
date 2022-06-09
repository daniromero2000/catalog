<?php

namespace Modules\Companies\Entities\Kpis\UseCases\Interfaces;

interface KpiUseCaseInterface
{
    public function listKpis(array $data): array;

    public function createKpi();

    public function storeKpi(array $requestData);

    public function updateKpi($request, int $id);

    public function destroyKpi(int $id);
}
