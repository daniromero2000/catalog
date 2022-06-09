<?php

namespace Modules\Companies\Entities\Employees\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'                 => $this->isRequired($this->validationRules()['person_names']),
            'last_name'            => $this->isRequired($this->validationRules()['person_names']),
            'employee_position_id' => $this->isRequired($this->validationRules()['id']),
            'subsidiary_id'        => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
