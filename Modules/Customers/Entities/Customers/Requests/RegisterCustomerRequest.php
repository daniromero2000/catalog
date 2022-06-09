<?php

namespace Modules\Customers\Entities\Customers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class RegisterCustomerRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isRequired($this->validationRules()['person_names']),
            'password'      => 'required|string|min:8|confirmed',
            'email'           => $this->isUnique($this->isRequired($this->validationRules()['emails']), 'customers'),
            'identity_number' => $this->isUnique($this->isRequired($this->validationRules()['string']), 'customer_identities'),
            'data_politics'   => $this->isRequired($this->validationRules()['status'])
        ];
    }

    public function messages(): array
    {
        return [
            'identity_number.unique'  => 'Ya existe un cliente registrado con este número de identificación'
        ];
    }
}
