<?php

namespace Modules\Companies\Entities\Companies\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCompanyRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'           => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'companies'),
            'identification' => $this->validationRules()['money'],
            'company_type'   => $this->validationRules()['string'],
            'country_id'     => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
