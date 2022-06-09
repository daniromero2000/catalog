<?php

namespace Modules\Customers\Entities\Customers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCustomerPasswordRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'password' => $this->isRequired($this->validationRules()['passwords'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
