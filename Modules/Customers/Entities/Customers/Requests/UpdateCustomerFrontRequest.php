<?php

namespace Modules\Customers\Entities\Customers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCustomerFrontRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isRequired($this->validationRules()['person_names']),
            'last_name'     => $this->isRequired($this->validationRules()['person_names']),
            'data_politics' => $this->isRequired($this->validationRules()['status'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
