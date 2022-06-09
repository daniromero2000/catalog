<?php

namespace Modules\Generals\Entities\Genres\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface GenreRepositoryInterface
{
    public function getAllGenresNames(): Collection;
}
