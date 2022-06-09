<?php

namespace Modules\Companies\Entities\EmployeeCommentaries\Repositories;

use Modules\Companies\Entities\EmployeeCommentaries\EmployeeCommentary;
use Modules\Companies\Entities\EmployeeCommentaries\Exceptions\CreateEmployeeCommentaryErrorException;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class EmployeeCommentaryRepository implements EmployeeCommentaryRepositoryInterface
{
    protected $model;

    public function __construct(EmployeeCommentary $EmployeeCommentary)
    {
        $this->model = $EmployeeCommentary;
        $this->columns = [
            'id',
            'commentary',
            'user',
            'created_at'
        ];
    }

    public function listEmployeeCommentaries(int $employeeId): Collection
    {
        return $this->model
            ->where('employee_id', $employeeId)
            ->get($this->columns);
    }

    public function createEmployeeCommentary(array $data): EmployeeCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeCommentaryErrorException($e->getMessage());
        }
    }
}
