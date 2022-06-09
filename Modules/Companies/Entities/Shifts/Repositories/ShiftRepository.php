<?php

namespace Modules\Companies\Entities\Shifts\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Shifts\Shift;
use Modules\Companies\Entities\Shifts\Exceptions\ShiftNotFoundException;
use Modules\Companies\Entities\Shifts\Exceptions\CreateShiftErrorException;
use Modules\Companies\Entities\Shifts\Exceptions\DeletingShiftErrorException;
use Modules\Companies\Entities\Shifts\Exceptions\UpdateShiftErrorException;
use Modules\Companies\Entities\Shifts\Repositories\Interfaces\ShiftRepositoryInterface;

class ShiftRepository implements ShiftRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'starts', 'end', 'goal_id', 'created_at'];

    public function __construct(Shift $Shift)
    {
        $this->model = $Shift;
    }

    public function createShift(array $data): Shift
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateShiftErrorException($e->getMessage());
        }
    }

    public function updateShift(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateShiftErrorException($e->getMessage());
        }
    }

    public function findShiftById(int $shiftId): Shift
    {
        try {
            return $this->model->findOrFail($shiftId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ShiftNotFoundException($e->getMessage());
        }
    }

    public function deleteShift(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingShiftErrorException($e->getMessage());
        }
    }

    public function searchShift(string $text = null): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listShifts();
        } else {
            return $this->model->searchShift($text)->with('goal')->select($this->columns)
                ->orderBy('name', 'desc')->paginate(10);
        }
    }

    private function listShifts(): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)->with('goal')
            ->orderBy('name', 'asc')->paginate(10);
    }

    public function getAllShiftNames(): Collection
    {
        return $this->model->get(['id', 'name']);
    }
}
