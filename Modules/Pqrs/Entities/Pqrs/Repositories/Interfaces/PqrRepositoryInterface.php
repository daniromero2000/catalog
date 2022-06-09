<?php

namespace Modules\Pqrs\Entities\Pqrs\Repositories\Interfaces;

use Modules\Pqrs\Entities\Pqrs\Pqr;
use Illuminate\Database\Eloquent\Collection;

interface PqrRepositoryInterface
{
    public function listPqrs($totalView);

    public function createPqr(array $data): Pqr;

    public function updatePqr(array $data): bool;

    public function findPqrById(int $id);

    public function deletePqr(): bool;

    public function searchPqr(string $text): Collection;

    public function sendEmailToCustomer($pqrMail);

    public function sendPqrsNotificationToAdmin($pqrMail);

    public function pqrsDaysLeft($pqrcreated_at);
}
