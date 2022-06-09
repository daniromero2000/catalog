<?php

namespace Modules\XisfoPay\Entities\ChaseTransfers\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ChaseTransfers\ChaseTransfer;

interface ChaseTransferRepositoryInterface
{
    public function createChaseTransfer(array $data): ChaseTransfer;

    public function updateChaseTransfer(array $data): bool;

    public function findChaseTransferById(int $id): ChaseTransfer;

    public function deleteChaseTransfer(): bool;

    public function searchChaseTransfers(string $text = null, $from = null, $to = null);

    public function getLastChaseTransfers(int $streamingId = null): Collection;

    public function findNotLegalizedChaseTransfers(): Collection;
}
