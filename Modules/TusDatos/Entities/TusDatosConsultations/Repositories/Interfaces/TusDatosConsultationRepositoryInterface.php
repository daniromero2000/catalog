<?php

namespace Modules\TusDatos\Entities\TusDatosConsultations\Repositories\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\TusDatos\Entities\TusDatosConsultations\TusDatosConsultation;

interface TusDatosConsultationRepositoryInterface
{
    public function createTusDatosConsultation(array $data): TusDatosConsultation;

    public function updateTusDatosConsultation(array $data): bool;

    public function findTusDatosConsultationById(int $id): TusDatosConsultation;

    public function searchTusDatosConsultation(string $text = null): LengthAwarePaginator;
}
