<?php

namespace Modules\XisfoPay\Entities\XisfoServices\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\XisfoServices\XisfoService;

interface XisfoServiceRepositoryInterface
{
    public function createXisfoService(array $data): XisfoService;

    public function updateXisfoService(array $data): bool;

    public function findXisfoServiceById(int $id): XisfoService;

    public function listXisfoServices($totalView): Collection;

    public function deleteXisfoService(): bool;

    public function searchXisfoService(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countXisfoService(string $text = null,  $from = null, $to = null);

    public function getAllXisfoServiceNames(): Collection;

    public function syncEmployee(array $data);
}
