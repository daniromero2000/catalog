<?php

namespace Modules\Customers\Entities\CustomerAddresses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateFrontCustomerAddressRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_address' => $this->isRequired($this->validationRules()['addresses']),
            'phone'            => $this->isUnique($this->isRequired($this->validationRules()['phones']), 'customer_phones')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
