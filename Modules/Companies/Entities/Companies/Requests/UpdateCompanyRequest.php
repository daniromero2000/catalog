<?php

namespace Modules\Companies\Entities\Companies\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCompanyRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'           => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'companies', 'name'),
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
