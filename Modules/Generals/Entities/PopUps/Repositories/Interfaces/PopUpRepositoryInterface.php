<?php

namespace Modules\Generals\Entities\PopUps\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface PopUpRepositoryInterface
{
    public function listPopUp(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection;
}
