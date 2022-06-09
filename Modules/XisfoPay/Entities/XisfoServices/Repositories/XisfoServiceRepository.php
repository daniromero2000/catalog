<?php

namespace Modules\XisfoPay\Entities\XisfoServices\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\XisfoPay\Entities\XisfoServices\XisfoService;
use Modules\XisfoPay\Entities\XisfoServices\Exceptions\XisfoServiceNotFoundException;
use Modules\XisfoPay\Entities\XisfoServices\Exceptions\CreateXisfoServiceErrorException;
use Modules\XisfoPay\Entities\XisfoServices\Exceptions\DeletingXisfoServiceErrorException;
use Modules\XisfoPay\Entities\XisfoServices\Exceptions\UpdateXisfoServiceErrorException;
use Modules\XisfoPay\Entities\XisfoServices\Repositories\Interfaces\XisfoServiceRepositoryInterface;

class XisfoServiceRepository implements XisfoServiceRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'name',
        'is_active',
        'created_at'
    ];

    public function __construct(XisfoService $paymentRequest)
    {
        $this->model = $paymentRequest;
    }

    public function createXisfoService(array $data): XisfoService
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateXisfoServiceErrorException($e->getMessage());
        }
    }

    public function updateXisfoService(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateXisfoServiceErrorException($e->getMessage());
        }
    }

    public function findXisfoServiceById(int $id): XisfoService
    {
        try {
            return $this->model
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new XisfoServiceNotFoundException($e->getMessage());
        }
    }

    public function listXisfoServices($totalView): Collection
    {
        return  $this->model->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteXisfoService(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingXisfoServiceErrorException($e->getMessage());
        }
    }

    public function searchXisfoService(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listXisfoServices($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchXisfoService($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchXisfoService($text)
            ->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function countXisfoService(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchXisfoService($text)->count();
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return  $this->model->whereBetween('created_at', [$from, $to])->count();
        }

        return $this->model->searchXisfoService($text)
            ->whereBetween('created_at', [$from, $to])->count();
    }

    public function getAllXisfoServiceNames(): Collection
    {
        return $this->model->where('is_active', 1)->orderBy('name', 'desc')
            ->get(['id', 'name']);
    }

    public function syncEmployee(array $data)
    {
        $this->model->Employee()->sync($data);
    }

    public function listEmployees(): Collection
    {
        return $this->model->Employee()->get($this->columns);
    }
}
