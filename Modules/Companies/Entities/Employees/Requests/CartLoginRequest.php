<?php

namespace Modules\Companies\Entities\Employees\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CartLoginRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'email' => $this->isRequired($this->validationRules()['emails'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
