<?php

namespace Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces;

use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CammodelRepositoryInterface
{
    public function searchCammodel(string $text = null): LengthAwarePaginator;

    public function searchSubsidiaryCammodel(string $text = null, $subsidiary_id): LengthAwarePaginator;

    public function createCamModel(array $data): Cammodel;

    public function findCammodelById(int $cammodelId): Cammodel;

    public function findCammodelBySlug(string $cammodelSlug): Cammodel;

    public function saveCoverPageImage(UploadedFile $file, Cammodel $cammodel): string;

    public function saveCammodelImages(Collection $collection, Cammodel $cammodel);

    public function updateCammodel(array $data): bool;

    public function syncCategories(array $data): array;

    public function detachCategories();

    public function getAllCammodels(): Collection;

    public function getAllCammodelNames(): Collection;

    public function getSubsidiaryCammodelNames(int $subsidiary_id): Collection;

    public function getAllCammodelsWithStreamAccounts(): Collection;

    public function getInactiveCammodelNames(): Collection;

    public function getSubsidiaryCammodels(int $subsidiary_id, int $inactivesTo = null): Collection;
}
