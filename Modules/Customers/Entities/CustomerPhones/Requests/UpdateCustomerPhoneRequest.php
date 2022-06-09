<?php

namespace Modules\Customers\Entities\CustomerPhones\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCustomerPhoneRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'customer_id' => $this->isRequired($this->validationRules()['id']),
            'phone'       => $this->isRequired($this->validationRules()['phones'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
