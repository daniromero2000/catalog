<?php

namespace Modules\Companies\Entities\Goals\UseCases\Interfaces;

interface GoalUseCaseInterface
{
    public function listGoals(array $data): array;

    public function createGoal();

    public function storeGoal(array $requestData);

    public function updateGoal($request, int $id);

    public function destroyGoal(int $id);
}
