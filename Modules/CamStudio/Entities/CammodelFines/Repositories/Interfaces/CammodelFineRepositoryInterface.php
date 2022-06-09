<?php

namespace Modules\CamStudio\Entities\CammodelFines\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelFines\CammodelFine;

interface CammodelFineRepositoryInterface
{
    public function createCammodelFine(array $data): CammodelFine;

    public function updateCammodelFine(array $data): bool;

    public function findCammodelFineById(int $cammodelFineId): CammodelFine;

    public function listCammodelFines(): LengthAwarePaginator;

    public function listSubsidiaryCammodelFines(int $subsidiary_id): LengthAwarePaginator;

    public function deleteCammodelFine(): bool;

    public function searchCammodelFine(string $text = null, $from = null, $to = null): LengthAwarePaginator;

    public function searchSubsidiaryCammodelFine(string $text = null, int $subsidiary_id, $from = null, $to = null): LengthAwarePaginator;

    public function getNotAvailableFouls($today): Collection;

    public function findUnchargedCammodelFinesByCammodel(int $cammodelId, array $dates): Collection;
}
