<?php

namespace Modules\Pqrs\Entities\PqrStatuses\Repositories\Interfaces;


use Modules\Pqrs\Entities\PqrStatuses\PqrStatus;
use Illuminate\Support\Collection;

interface PqrStatusRepositoryInterface
{
    public function createPqrStatus(array $pqrStatusData): PqrStatus;

    public function updatePqrStatus(array $data): bool;

    public function findPqrStatusById(int $id): PqrStatus;

    public function listPqrStatuses(): Collection;

    public function deletePqrStatus(): bool;

    public function findPqrs(): Collection;

    public function findByName(string $name);
}
