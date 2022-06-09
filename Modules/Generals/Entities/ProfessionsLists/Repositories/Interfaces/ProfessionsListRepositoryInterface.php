<?php

namespace Modules\Generals\Entities\ProfessionsLists\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface ProfessionsListRepositoryInterface
{
    public function getAllProfessionsNames(): Collection;
}
