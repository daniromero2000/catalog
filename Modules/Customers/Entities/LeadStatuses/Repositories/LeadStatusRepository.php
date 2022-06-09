<?php

namespace Modules\Customers\Entities\LeadStatuses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Customers\Entities\LeadStatuses\LeadStatus;
use Modules\Customers\Entities\LeadStatuses\Exceptions\LeadStatusNotFoundException;
use Modules\Customers\Entities\LeadStatuses\Exceptions\CreateLeadStatusErrorException;
use Modules\Customers\Entities\LeadStatuses\Exceptions\DeletingLeadStatusErrorException;
use Modules\Customers\Entities\LeadStatuses\Exceptions\UpdateLeadStatusErrorException;
use Modules\Customers\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;

class LeadStatusRepository implements LeadStatusRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'color',
        'is_active',
        'created_at'
    ];

    public function __construct(LeadStatus $contractStatus)
    {
        $this->model = $contractStatus;
    }

    public function createLeadStatus(array $data): LeadStatus
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateLeadStatusErrorException($e->getMessage());
        }
    }

    public function updateLeadStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateLeadStatusErrorException($e->getMessage());
        }
    }

    public function findLeadStatusById(int $id): LeadStatus
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new LeadStatusNotFoundException($e->getMessage());
        }
    }

    public function listLeadStatuses($totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteLeadStatus(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingLeadStatusErrorException($e->getMessage());
        }
    }

    public function searchLeadStatus(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }
        return $this->model->searchLeadStatus($text)->get($this->columns);
    }

    public function getAllLeadStatusesNames(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get($this->columns);
    }
}
