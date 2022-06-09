<?php

namespace Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ChaseTransferTrms\ChaseTransferTrm;

interface ChaseTransferTrmRepositoryInterface
{
    public function createChaseTransferTrm(array $data): ChaseTransferTrm;

    public function updateChaseTransferTrm(array $data): bool;

    public function findChaseTransferTrmById(int $id): ChaseTransferTrm;

    public function deleteChaseTransferTrm(): bool;

    public function searchChaseTransferTrms(string $text = null, $from = null, $to = null, $active = null);

    public function getActiveChaseTransferTrm(): Collection;

    public function deactivateTRMs($bank);
}
