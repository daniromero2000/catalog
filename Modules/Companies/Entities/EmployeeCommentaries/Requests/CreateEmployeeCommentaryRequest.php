<?php

namespace  Modules\Companies\Entities\EmployeeCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'employee_id' => $this->isRequired($this->validationRules()['id']),
            'commentary'  => $this->isRequired($this->validationRules()['text'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
