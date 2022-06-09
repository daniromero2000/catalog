<?php

namespace Modules\Pqrs\Entities\PqrsStatusesLogs\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Modules\Pqrs\Entities\PqrsStatusesLogs\PqrsStatusesLog;
use Modules\Pqrs\Entities\PqrsStatusesLogs\Repositories\Interfaces\PqrsStatusesLogRepositoryInterface;
use Modules\Pqrs\Entities\PqrsStatusesLogs\Exceptions\CreatePqrsStatusesLogInvalidArgumentException;
use Carbon\CarbonInterval;

class PqrsStatusesLogRepository implements PqrsStatusesLogRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(PqrsStatusesLog $pqrsStatusesLog)
    {
        $this->model = $pqrsStatusesLog;
    }

    public function createPqrsStatusesLog(array $attributes): PqrsStatusesLog
    {
        try {
            $pqrsStatusesLog = new PqrsStatusesLog($attributes);
            $pqrsStatusesLog->save();

            return $pqrsStatusesLog;
        } catch (QueryException $e) {
            throw new CreatePqrsStatusesLogInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    public function pqrStatusDaysPassed($pqrCreatedAt)
    {
        return CarbonInterval::seconds($pqrCreatedAt->diffInSeconds(Carbon::now()))->cascade()->forHumans();
    }
}
