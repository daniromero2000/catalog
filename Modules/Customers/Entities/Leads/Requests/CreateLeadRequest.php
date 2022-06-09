<?php

namespace Modules\Customers\Entities\Leads\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateLeadRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'                  => $this->isRequired($this->validationRules()['person_names']),
            'last_name'             => $this->isRequired($this->validationRules()['person_names']),
            'phone'                 => $this->isRequired($this->validationRules()['phones']),
            'city_id'               => $this->isRequired($this->validationRules()['id']),
            'customer_channel_id'   => $this->isRequired($this->validationRules()['id']),
            'service_id'            => $this->isRequired($this->validationRules()['id']),
            'data_politics'         => $this->isRequired($this->validationRules()['status'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
