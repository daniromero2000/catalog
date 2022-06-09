<?php

namespace Modules\Pqrs\Entities\PqrsStatusesLogs\Repositories\Interfaces;

use Modules\Pqrs\Entities\PqrsStatusesLogs\PqrsStatusesLog;


interface PqrsStatusesLogRepositoryInterface
{
    public function createPqrsStatusesLog(array $data): PqrsStatusesLog;
}
