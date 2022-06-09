<?php

namespace Modules\Companies\Entities\CorporatePhones\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\CorporatePhones\CorporatePhone;
use Modules\Companies\Entities\CorporatePhones\Exceptions\CorporatePhoneInvalidArgumentException;
use Modules\Companies\Entities\CorporatePhones\Repositories\Interfaces\CorporatePhonesRepositoryInterface;
use Modules\Companies\Entities\CorporatePhones\Exceptions\CorporatePhoneNotFoundException;

class CorporatePhonesRepository implements CorporatePhonesRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'simcard_number',
        'operator',
        'phone',
        'description'
    ];

    public function __construct(CorporatePhone $corporatePhone)
    {
        $this->model = $corporatePhone;
    }

    public function createCorporatePhone(array $data): CorporatePhone
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CorporatePhoneInvalidArgumentException($e->getMessage());
        }
    }

    public function updateCorporatePhone(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new CorporatePhoneInvalidArgumentException($e->getMessage());
        }
    }

    public function findCorporatePhoneById(int $id): CorporatePhone
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CorporatePhoneNotFoundException($e->getMessage());
        }
    }

    public function listCorporatePhones($totalView): Collection
    {
        return  $this->model->orderBy('phone', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function getAllCorporatePhones(): Collection
    {
        return $this->model->orderBy('phone', 'asc')->get($this->columns);
    }

    public function deleteCorporatePhone(): bool
    {
        return $this->model->delete();
    }

    public function searchCorporatePhones(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }
        return $this->model->searchCorporatePhones($text)->get($this->columns);
    }

    public function countCorporatePhones(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchCorporatePhones($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchCorporatePhones($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }
}
