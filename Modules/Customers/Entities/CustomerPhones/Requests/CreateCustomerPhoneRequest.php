<?php

namespace Modules\Customers\Entities\CustomerPhones\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerPhoneRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => $this->isRequired($this->validationRules()['id']),
            'phone_type'  => $this->isRequired($this->validationRules()['string']),
            'phone'       => $this->isRequired($this->validationRules()['phones']),
            'prefix'      => $this->validationRules()['string']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
