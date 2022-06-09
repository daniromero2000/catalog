<?php

namespace Modules\Customers\Entities\LeadReasons\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Customers\Entities\LeadReasons\LeadReason;
use Modules\Customers\Entities\LeadReasons\Repositories\Interfaces\LeadReasonRepositoryInterface;

class LeadReasonRepository implements LeadReasonRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'reason',
        'company_id',
        'created_at'
    ];

    public function __construct(LeadReason $leadReason)
    {
        $this->model = $leadReason;
    }

    public function createLeadReason(array $data): LeadReason
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateLeadReasonErrorException($e->getMessage());
        }
    }

    public function updateLeadReason(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateLeadReasonErrorException($e->getMessage());
        }
    }

    public function findLeadReasonById(int $id): LeadReason
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new LeadReasonNotFoundException($e->getMessage());
        }
    }

    public function listLeadReasons($totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteLeadReason(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingLeadReasonErrorException($e->getMessage());
        }
    }

    public function searchLeadReason(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }
        return $this->model->searchLeadReason($text)->get($this->columns);
    }

    public function getAllLeadReasonsNames(): Collection
    {
        return $this->model->orderBy('id', 'asc')->get($this->columns);
    }
}
