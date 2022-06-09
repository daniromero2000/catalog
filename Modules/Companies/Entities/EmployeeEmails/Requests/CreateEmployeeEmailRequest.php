<?php

namespace Modules\Companies\Entities\EmployeeEmails\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeEmailRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'employee_id' => $this->isRequired($this->validationRules()['id']),
            'email_type'  => $this->isRequired($this->validationRules()['string']),
            'email'       => $this->isRequired($this->validationRules()['emails'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
