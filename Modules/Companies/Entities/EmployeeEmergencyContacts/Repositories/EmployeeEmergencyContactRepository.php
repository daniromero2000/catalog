<?php

namespace Modules\Companies\Entities\EmployeeEmergencyContacts\Repositories;

use Illuminate\Database\QueryException;
use Modules\Companies\Entities\EmployeeAddresses\Exceptions\CreateEmployeeEmergencyContactErrorException;
use Modules\Companies\Entities\EmployeeEmergencyContacts\EmployeeEmergencyContact;
use Modules\Companies\Entities\EmployeeEmergencyContacts\Repositories\Interfaces\EmployeeEmergencyContactRepositoryInterface;

class EmployeeEmergencyContactRepository implements EmployeeEmergencyContactRepositoryInterface
{
    protected $model;

    public function __construct(EmployeeEmergencyContact $employeeEmergencyContact)
    {
        $this->model = $employeeEmergencyContact;
    }

    public function createEmployeeEmergencyContact(array $data): EmployeeEmergencyContact
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeEmergencyContactErrorException($e->getMessage());
        }
    }
}
