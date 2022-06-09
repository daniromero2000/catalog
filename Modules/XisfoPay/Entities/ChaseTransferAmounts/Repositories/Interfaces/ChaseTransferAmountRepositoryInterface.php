<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\ChaseTransferAmount;

interface ChaseTransferAmountRepositoryInterface
{
    public function createChaseTransferAmount(array $data): ChaseTransferAmount;

    public function updateChaseTransferAmount(array $data): bool;

    public function findChaseTransferAmountById(int $id): ChaseTransferAmount;

    public function deleteChaseTransferAmount(): bool;

    public function searchChaseTransferAmounts(string $text = null, $from = null, $to = null);

    public function findChaseTransferAmounts(int $chaseTransferId): Collection;
}
