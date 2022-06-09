<?php

namespace Modules\Companies\Entities\Companies\Repositories;

use Modules\Companies\Entities\Companies\Company;
use Modules\Companies\Entities\Companies\Repositories\Interfaces\CompanyRepositoryInterface;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Companies\Exceptions\CompanyNotFoundException;
use Modules\Companies\Entities\Companies\Exceptions\CreateCompanyErrorException;
use Modules\Companies\Entities\Companies\Exceptions\UpdateCompanyErrorException;

class CompanyRepository implements CompanyRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'name',
        'identification',
        'company_type',
        'logo',
        'is_active'
    ];

    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function listCompanies(int $totalView): Collection
    {
        return  $this->model->orderBy('name', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function createCompany(array $data): Company
    {
        try {
            $collection = collect($data);
            if (isset($data['name'])) {
                $slug = str_slug($data['name']);
            }
            if (isset($data['logo']) && ($data['logo'] instanceof UploadedFile)) {
                $logo = $this->uploadOne($data['logo'], 'companies');
            }
            $merge = $collection->merge(compact('logo'));
            $company = new Company($merge->all());
            $company->save();

            return $company;
        } catch (QueryException $e) {
            throw new CreateCompanyErrorException($e->getMessage());
        }
    }

    public function updateCompany(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCompanyErrorException($e->getMessage());
        }
    }

    public function findCompanyById(int $id): Company
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CompanyNotFoundException($e->getMessage());
        }
    }

    public function deleteCompany(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchCompany(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }

        return $this->model->searchCompany($text)->get($this->columns);
    }
}
