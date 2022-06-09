<?php

namespace Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces;

use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Illuminate\Support\Collection;

interface SubsidiaryRepositoryInterface
{
    public function getAllSubsidiaryNames(): Collection;

    public function listSubsidiaries(int $totalView): Collection;

    public function createSubsidiary(array $data): Subsidiary;

    public function updateSubsidiary(array $data): bool;

    public function findSubsidiaryById(int $subsidiaryId): Subsidiary;

    public function deleteSubsidiary(): bool;
}
