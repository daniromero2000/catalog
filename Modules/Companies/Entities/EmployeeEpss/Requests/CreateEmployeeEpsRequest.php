<?php

namespace Modules\Companies\Entities\EmployeeEpss\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeEpsRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'employee_id' => $this->isRequired($this->validationRules()['id']),
            'eps_id'      => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
