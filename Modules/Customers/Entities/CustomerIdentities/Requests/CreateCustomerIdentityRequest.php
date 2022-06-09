<?php

namespace Modules\Customers\Entities\CustomerIdentities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerIdentityRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'identity_number'  => $this->isUnique($this->isRequired($this->validationRules()['identities']), 'customer_identities'),
            'expedition_date'  => $this->isRequired($this->validationRules()['dates']),
            'city_id'          => $this->isRequired($this->validationRules()['id']),
            'customer_id'      => $this->isRequired($this->validationRules()['id']),
            'identity_type_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [
            'identity_number.unique'    => 'El número de identificación ingresado ya existe en la base de datos',
            'identity_number.required'  => 'Debe ingresar el número de identificación',
            'expedition_date.required'  => 'Debe ingresar la fecha de expedición del documento',
            'identity_type_id.required' => 'Debe seleccionar el tipo de identificación',
            'identity_number'           => 'El tamaño máximo del número de identificación es de 20 dígitos'
        ];
    }
}
