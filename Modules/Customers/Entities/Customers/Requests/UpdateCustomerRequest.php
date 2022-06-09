<?php

namespace Modules\Customers\Entities\Customers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCustomerRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'             => $this->isRequired($this->validationRules()['person_names']),
            'last_name'        => $this->isRequired($this->validationRules()['person_names']),
            'city_id'          => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
