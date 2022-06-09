<?php

namespace Modules\Companies\Entities\Actions\Repositories\Interfaces;

use Modules\Companies\Entities\Actions\Action;
use Illuminate\Support\Collection;

interface ActionRepositoryInterface
{
    public function createAction(array $data);

    public function findActionById(int $id): Action;

    public function updateAction(array $data): bool;

    public function deleteAction(): bool;

    public function listActions(int $totalView): Collection;

    public function searchAction(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countAction(string $text = null,  $from = null, $to = null);

    public function getAttachedActionNames($attachedPermissionsArrayIds): Collection;
}
