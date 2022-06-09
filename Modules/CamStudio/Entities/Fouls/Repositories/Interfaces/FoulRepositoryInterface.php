<?php

namespace Modules\CamStudio\Entities\Fouls\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\Fouls\Foul;

interface FoulRepositoryInterface
{
    public function createFoul(array $data): Foul;

    public function updateFoul(array $data): bool;

    public function findFoulById(int $foulId): Foul;

    public function listFouls($totalView): Collection;

    public function deleteFoul(): bool;

    public function searchFoul(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countFoul(string $text = null,  $from = null, $to = null);

    public function getAllFoulNames();
}
