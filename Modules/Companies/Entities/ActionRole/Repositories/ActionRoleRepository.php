<?php

namespace Modules\Companies\Entities\ActionRole\Repositories;

use Illuminate\Database\QueryException;
use Modules\Companies\Entities\ActionRole\ActionRole;
use Modules\Companies\Entities\ActionRole\Repositories\Interfaces\ActionRoleRepositoryInterface;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\ActionRole\Exceptions\CreateActionRoleErrorException;

class ActionRoleRepository implements ActionRoleRepositoryInterface
{
    protected $model;
    private $columns = ['action_id', 'role_id'];

    public function __construct(ActionRole $actionRole)
    {
        $this->model = $actionRole;
    }

    public function createActionRole(array $data): ActionRole
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateActionRoleErrorException($e->getMessage());
        }
    }

    public function listActionRole(): Collection
    {
        return $this->model->all($this->columns);
    }
}
