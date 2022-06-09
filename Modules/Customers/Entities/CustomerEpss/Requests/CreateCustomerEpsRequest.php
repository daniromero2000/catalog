<?php

namespace Modules\Customers\Entities\CustomerEpss\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerEpsRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => $this->isRequired($this->validationRules()['id']),
            'eps_id'      => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
