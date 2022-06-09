<?php

namespace Modules\CamStudio\Entities\CammodelImages\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelImages\CammodelImage;

interface CammodelImageRepositoryInterface
{
    public function findCammodelImageBySlug(string $slug): CammodelImage;

    public function deleteThumb(string $src): bool;

    public function getAllCammodelImages(): Collection;
}
