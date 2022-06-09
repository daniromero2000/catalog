<?php

namespace Modules\Companies\Entities\Kpis\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Companies\Entities\Kpis\Kpi;

interface KpiRepositoryInterface
{
    public function createKpi(array $data): Kpi;

    public function updateKpi(array $data): bool;

    public function findKpiById(int $id): Kpi;

    public function listKpis();

    public function deleteKpi(): bool;

    public function searchKpi(string $text = null, $from = null, $to = null);

    public function getActiveKpis(): Collection;

    public function findKpiByShiftAndSubsidiary(int $subsidiaryId, int $shitfId);
}
