<?php

namespace Modules\Companies\Entities\Subsidiaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateSubsidiaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['addresses']), 'subsidiaries', 'name'),
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
