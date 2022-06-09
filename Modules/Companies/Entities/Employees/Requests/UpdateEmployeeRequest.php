<?php

namespace Modules\Companies\Entities\Employees\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateEmployeeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'         => $this->isRequired($this->validationRules()['person_names']),
            'rh'           => $this->isRequired($this->validationRules()['rhs']),
            'bank_account' => $this->isRequired($this->validationRules()['string']),
            'last_name'    => $this->isRequired($this->validationRules()['person_names']),
            'is_active'    => $this->isRequired($this->validationRules()['is_active']),
            'email'        => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['emails']), 'employees', 'email')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
