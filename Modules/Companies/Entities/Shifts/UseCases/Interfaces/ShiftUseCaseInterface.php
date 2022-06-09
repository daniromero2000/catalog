<?php

namespace Modules\Companies\Entities\Shifts\UseCases\Interfaces;

interface ShiftUseCaseInterface
{
    public function listShifts(array $data): array;

    public function createShift(): array;

    public function storeShift(array $requestData): void;

    public function updateShift($request, int $id): void;

    public function destroyShift(int $id): void;
}
