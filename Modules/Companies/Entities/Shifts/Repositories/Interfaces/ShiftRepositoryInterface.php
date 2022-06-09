<?php

namespace Modules\Companies\Entities\Shifts\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Shifts\Shift;

interface ShiftRepositoryInterface
{
    public function createShift(array $data): Shift;

    public function updateShift(array $data): bool;

    public function findShiftById(int $shiftId): Shift;

    public function deleteShift(): bool;

    public function searchShift(string $text = null): LengthAwarePaginator;

    public function getAllShiftNames(): Collection;
}
