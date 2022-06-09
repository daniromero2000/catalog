<?php

namespace Modules\XisfoPay\Entities\ChaseTransfers\UseCases\Interfaces;

interface ChaseTransferUseCaseInterface
{
    public function listChaseTransfers(array $data): array;

    public function createChaseTransfer();

    public function storeChaseTransfer(array $requestData);

    public function showChaseTransfer(int $id);

    public function updateChaseTransfer(array $request, int $id);

    public function destroyChaseTransfer(int $id);

    public function legalizeViewData();

    public function legalizeChaseTransfers(array $requestData);
}
