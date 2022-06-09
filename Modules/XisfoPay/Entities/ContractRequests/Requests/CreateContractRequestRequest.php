<?php

namespace Modules\XisfoPay\Entities\ContractRequests\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractRequestRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_group_id'       => $this->isRequired($this->validationRules()['id']),
            'name'                    => $this->isRequired($this->validationRules()['person_names']),
            'last_name'               => $this->isRequired($this->validationRules()['person_names']),
            'birthday'                => $this->isRequired($this->validationRules()['dates']),
            'genre_id'                => $this->isRequired($this->validationRules()['id']),
            'email'                   => $this->isUnique($this->isRequired($this->validationRules()['emails']), 'customers'),
            'phone'                   => $this->isRequired($this->validationRules()['phones']),
            'customer_address'        => $this->isRequired($this->validationRules()['addresses']),
            'neighborhood'            => $this->isRequired($this->validationRules()['string']),
            'identity_type_id'        => $this->isRequired($this->validationRules()['id']),
            'identity_number'         => ['required', 'bail', 'max: 20', 'unique:customer_identities'],
            'expedition_date'         => $this->isRequired($this->validationRules()['dates']),
            'constitution_type'       => $this->isRequired($this->validationRules()['string']),
            'company_commercial_name' => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'customer_companies'),
            'company_legal_name'      => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'customer_companies'),
            'city_id'                 => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [
            'company_legal_name.unique'      => 'Ya existe un cliente registrado con este Nombre Legal',
            'company_commercial_name.unique' => 'Ya existe un cliente registrado con este Nombre Comercial',
            'identity_number.unique'         => 'Ya existe un cliente registrado con este número de identificación'
        ];
    }
}
