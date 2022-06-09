<?php

namespace Modules\Generals\Entities\Schedulers\Repositories\Interfaces;

use Modules\Generals\Entities\Schedulers\Scheduler;
use Illuminate\Support\Collection;

interface SchedulerRepositoryInterface
{
    public function createScheduler(array $data);

    public function searchScheduler(string $text = null): Collection;

    public function listSchedulers(int $totalView): Collection;

    public function findSchedulerById(int $id): Scheduler;

    public function deleteScheduler(): bool;

    public function getAllSchedulerNames();

    public function countScheduler(string $text = null,  $from = null, $to = null);

    public function findSchedulerByIdEmployee($employee_id);
}
