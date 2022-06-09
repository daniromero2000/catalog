<?php

namespace Modules\XisfoPay\Entities\ContractRequests\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateFrontContractRequestRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'                    => $this->isRequired($this->validationRules()['person_names']),
            'last_name'               => $this->isRequired($this->validationRules()['person_names']),
            'birthday'                => $this->isRequired($this->validationRules()['dates']),
            'city_id'                 => $this->isRequired($this->validationRules()['id']),
            'email'                   => $this->isUnique($this->isRequired($this->validationRules()['emails']), 'customers'),
            'phone'                   => $this->isRequired($this->validationRules()['phones']),
            'customer_address'        => $this->isRequired($this->validationRules()['addresses']),
            'identity_type_id'        => $this->isRequired($this->validationRules()['id']),
            'identity_number'         => ['required', 'bail', 'max:20', 'unique:customer_identities'],
            'expedition_date'         => $this->isRequired($this->validationRules()['dates']),
            'constitution_type'       => $this->isRequired($this->validationRules()['string']),
            'company_commercial_name' => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'customer_companies'),
            'company_legal_name'      => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'customer_companies'),
            'company_city_id'         => $this->isRequired($this->validationRules()['id']),
            'data_politics'           => $this->isRequired($this->validationRules()['status']),
            'g-recaptcha-response'    => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'company_legal_name.unique' => 'Ya existe un cliente registrado con este Nombre Legal'
        ];
    }
}
