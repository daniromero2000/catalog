<?php

namespace Modules\Companies\Entities\InterviewStatuses\Repositories\Interfaces;

use Modules\Companies\Entities\InterviewStatuses\InterviewStatus;
use Illuminate\Support\Collection;

interface InterviewStatusRepositoryInterface
{
    public function createInterviewStatus(array $InterviewStatusData): InterviewStatus;

    public function updateInterviewStatus(array $data): bool;

    public function findInterviewStatusById(int $id): InterviewStatus;

    public function listInterviewStatuses($totalView): Collection;

    public function getAllInterviewStatusesNames(): Collection;

    public function deleteInterviewStatus(): bool;

    public function findOrders(): Collection;

    public function findByName(string $name);

    public function searchInterviewStatuses(string $text = null, int $totalView, $from = null, $to = null): Collection;
    
    public function countInterviewStatuses(string $text = null,  $from = null, $to = null);
}
