<?php

namespace Modules\Customers\Entities\CustomerReferences\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerReferenceRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_id'       => $this->isRequired($this->validationRules()['id']),
            'name'              => $this->isRequired($this->validationRules()['person_names']),
            'last_name'         => $this->isRequired($this->validationRules()['person_names']),
            'phone'             => $this->isRequired($this->validationRules()['phones']),
            'email'             => $this->isRequired($this->validationRules()['emails']),
            'relationship_id'   => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
