<?php

namespace Modules\TusDatos\Entities\TusDatosConsultations\UseCases\Interfaces;

use Modules\TusDatos\Entities\TusDatosConsultations\TusDatosConsultation;

interface TusDatosConsultationUseCaseInterface
{
    public function listTusDatosConsultations(array $data): array;

    public function createTusDatosConsultation(): array;

    public function storeTusDatosConsultation(array $requestData): TusDatosConsultation;

    public function updateTusDatosConsultation(array $request, int $id): bool;

    public function destroyTusDatosConsultation(int $id): bool;

    public function launchCustomerConsultation(array $customerIdData): array;
}
