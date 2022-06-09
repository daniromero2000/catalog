<?php

namespace Modules\Generals\Entities\Scholarities\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface ScholarityRepositoryInterface
{
    public function getAllScholaritiesNames(): Collection;
}
