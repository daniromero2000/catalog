<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts\UseCases\Interfaces;

interface ChaseTransferAmountUseCaseInterface
{
    public function listChaseTransferAmounts(array $data): array;

    public function createChaseTransferAmount();

    public function storeChaseTransferAmount($requestData);

    public function showChaseTransferAmount(int $id);

    public function updateChaseTransferAmount(array $request, int $id);

    public function destroyChaseTransferAmount(int $id);

    public function storeChaseBankMovements($chaseTransfer);
}
