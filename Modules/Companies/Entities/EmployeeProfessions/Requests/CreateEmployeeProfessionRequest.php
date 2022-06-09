<?php

namespace Modules\Companies\Entities\EmployeeProfessions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeProfessionRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'professions_list_id' => $this->isRequired($this->validationRules()['id']),
            'employee_id'         => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
