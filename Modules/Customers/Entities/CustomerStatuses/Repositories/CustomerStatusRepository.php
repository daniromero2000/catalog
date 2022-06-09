<?php

namespace Modules\Customers\Entities\CustomerStatuses\Repositories;

use Modules\Customers\Entities\CustomerStatuses\CustomerStatus;
use Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces\CustomerStatusRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class CustomerStatusRepository implements CustomerStatusRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'is_active', 'color', 'name'];

    public function __construct(CustomerStatus $customerStatus)
    {
        $this->model = $customerStatus;
    }

    public function createCustomerStatus(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCustomerStatus(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCustomerStatusById(int $id): CustomerStatus
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCustomerStatuses(): Collection
    {
        return $this->model->orderBy('is_active', 'asc')->get($this->columns);
    }

    public function deleteCustomerStatus(): bool
    {
        return $this->model->delete();
    }

    public function searchCustomerStatuses(?string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCustomerStatuses($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCustomerStatuses($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchCustomerStatuses($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('percentage', 'desc')->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function countCustomerStatuses(?string $text = null, $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchCustomerStatuses($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchCustomerStatuses($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function listCustomerStatus($totalView): Collection
    {
        return  $this->model->orderBy('name', 'asc')
            ->skip($totalView)->take(10)->get($this->columns);
    }
}
