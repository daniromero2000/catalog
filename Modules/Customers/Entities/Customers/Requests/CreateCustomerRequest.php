<?php

namespace Modules\Customers\Entities\Customers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'                => $this->isRequired($this->validationRules()['person_names']),
            'last_name'           => $this->isRequired($this->validationRules()['person_names']),
            'birthday'            => $this->validationRules()['dates'],
            'scholarity_id'       => $this->isRequired($this->validationRules()['id']),
            'customer_channel_id' => $this->isRequired($this->validationRules()['id']),
            'city_id'             => $this->isRequired($this->validationRules()['id']),
            'genre_id'            => $this->isRequired($this->validationRules()['id']),
            'civil_status_id'     => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
