<?php

namespace Modules\Companies\Entities\EmployeeEmergencyContacts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeEmergencyContactRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'employee_id' => $this->isRequired($this->validationRules()['id']),
            'name'        => $this->isRequired($this->validationRules()['person_names']),
            'phone'       => $this->isRequired($this->validationRules()['phones'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
