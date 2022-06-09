<?php

namespace Modules\XisfoPay\Entities\ContractRequests\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateNewContractRequestRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'constitution_type'       => $this->isRequired($this->validationRules()['string']),
            'identity_number'         => ['required', 'bail', 'max:20', 'unique:customer_identities'],
            'expedition_date'         => $this->isRequired($this->validationRules()['dates']),
            'company_commercial_name' => $this->isRequired($this->validationRules()['commercial_names']),
            'company_legal_name'      => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'customer_companies'),
            'company_city_id'         => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [
            'company_legal_name.unique'      => 'Ya existe un cliente registrado con este Nombre Legal',
            'company_commercial_name.unique' => 'Ya existe un cliente registrado con este Nombre Comercial',
            'identity_number.unique'         => 'Ya existe un cliente registrado con esta identificación'
        ];
    }
}
