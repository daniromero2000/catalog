<?php

namespace Modules\Companies\Entities\EmployeePhones\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeePhoneRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'employee_id' => $this->isRequired($this->validationRules()['id']),
            'phone_type'  => $this->isRequired($this->validationRules()['string']),
            'phone'       => $this->isUnique($this->isRequired($this->validationRules()['phones']), 'employee_phones')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
