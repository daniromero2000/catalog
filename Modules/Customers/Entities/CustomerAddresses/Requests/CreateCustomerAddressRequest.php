<?php

namespace Modules\Customers\Entities\CustomerAddresses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerAddressRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_address' => $this->isRequired($this->validationRules()['addresses'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
