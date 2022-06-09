<?php

namespace Modules\Companies\Entities\EmployeeAddresses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeAddressRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'employee_id' => $this->isRequired($this->validationRules()['id']),
            'housing_id'  => $this->isRequired($this->validationRules()['id']),
            'stratum_id'  => $this->isRequired($this->validationRules()['id']),
            'city_id'     => $this->isRequired($this->validationRules()['id']),
            'address'     => $this->isRequired($this->validationRules()['addresses']),
            'time_living' => $this->validationRules()['numeric']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
