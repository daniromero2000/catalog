<?php

namespace Modules\Companies\Entities\Interviews\Repositories\Interfaces;

use Modules\Companies\Entities\Interviews\Interview;
use Illuminate\Support\Collection;

interface InterviewRepositoryInterface
{
    public function createInterview(array $data): Interview;

    public function updateInterview(array $data): bool;

    public function findInterviewById(int $id): Interview;

    public function listInterviews(int $totalView): Collection;

    public function removeInterview(): bool;

    public function searchInterview(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countInterview(string $text = null,  $from = null, $to = null);
}
