<?php

namespace Modules\Companies\Entities\EmployeeEmergencyContacts\Repositories\Interfaces;

use Modules\Companies\Entities\EmployeeEmergencyContacts\EmployeeEmergencyContact;

interface EmployeeEmergencyContactRepositoryInterface
{
    public function createEmployeeEmergencyContact(array $data): EmployeeEmergencyContact;
}
