<?php

namespace Modules\Companies\Entities\EmployeeIdentities\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Companies\Entities\EmployeeIdentities\EmployeeIdentity;
use Modules\Companies\Entities\EmployeeIdentities\Repositories\Interfaces\EmployeeIdentityRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Companies\Entities\EmployeeIdentities\Exceptions\CreateEmployeeIdentityErrorException;
use Modules\Companies\Entities\EmployeeIdentities\Exceptions\EmployeeIdentityNotFoundException;

class EmployeeIdentityRepository implements EmployeeIdentityRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'identity_type_id', 'identity_number', 'expedition_date', 'city_id', 'status', 'created_at'];

    public function __construct(
        EmployeeIdentity $employeeIdentity
    ) {
        $this->model = $employeeIdentity;
    }

    public function createEmployeeIdentity(array $data): EmployeeIdentity
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeIdentityErrorException($e->getMessage());
        }
    }

    public function checkIfExists($request)
    {
        if ($employeeIdentity = $this->findEmployeeIdentity($request, $this->columns)) {
            return $employeeIdentity;
        } else {
            return;
        }
    }

    private function findEmployeeIdentity($data)
    {
        try {
            if (!empty($employeeIdentity = $this->model->where('identity_number', $data)->first())) {
                return  $employeeIdentity;
            } else {
                return;
            }
        } catch (ModelNotFoundException $e) {
            throw new EmployeeIdentityNotFoundException($e->getMessage());
        }
    }

    public static function staticCheckIfExists($request)
    {
        try {
            return EmployeeIdentity::select('id')->where('identity_number', $request->employee_identity)->firstOrFail();  
        } catch (ModelNotFoundException $e) {
            throw new EmployeeIdentityNotFoundException($e);
        }
    }
}
