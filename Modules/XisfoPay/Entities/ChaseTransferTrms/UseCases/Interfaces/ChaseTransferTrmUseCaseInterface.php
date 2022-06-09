<?php

namespace Modules\XisfoPay\Entities\ChaseTransferTrms\UseCases\Interfaces;

interface ChaseTransferTrmUseCaseInterface
{
    public function listChaseTransferTrms(array $data): array;

    public function createChaseTransferTrm();

    public function storeChaseTransferTrm(array $requestData);

    public function updateChaseTransferTrm(array $request, int $id);

    public function destroyChaseTransferTrm(int $id);
}
