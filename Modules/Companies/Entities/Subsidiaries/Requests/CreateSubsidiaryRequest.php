<?php

namespace Modules\Companies\Entities\Subsidiaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateSubsidiaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isUnique($this->isRequired($this->validationRules()['addresses']), 'subsidiaries'),
            'address'       => $this->isRequired($this->validationRules()['addresses']),
            'phone'         => $this->isRequired($this->validationRules()['phones']),
            'opening_hours' => $this->validationRules()['string'],
            'city_id'       => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
