<?php

namespace Modules\Companies\Entities\EmployeeIdentities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeIdentityRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'identity_number'  => $this->isRequired($this->validationRules()['string']),
            'expedition_date'  => $this->isRequired($this->validationRules()['dates']),
            'city_id'          => $this->isRequired($this->validationRules()['id']),
            'employee_id'      => $this->isRequired($this->validationRules()['id']),
            'identity_type_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
