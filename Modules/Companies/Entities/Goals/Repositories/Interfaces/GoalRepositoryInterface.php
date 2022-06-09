<?php

namespace Modules\Companies\Entities\Goals\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Companies\Entities\Goals\Goal;

interface GoalRepositoryInterface
{
    public function createGoal(array $data): Goal;

    public function updateGoal(array $data): bool;

    public function findGoalById(int $id): Goal;

    public function listGoals($totalView): Collection;

    public function deleteGoal(): bool;

    public function searchGoal(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countGoal(string $text = null,  $from = null, $to = null);

    public function getAllGoalNames();
}
