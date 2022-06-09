<?php

namespace Modules\Companies\Entities\Employees\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'email'    => $this->isRequired($this->validationRules()['emails']),
            'password' => $this->isRequired($this->validationRules()['passwords'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
