<?php

namespace Modules\Banking\Entities\Banks\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateBankRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'banks'),
            'transfer_rate' => $this->isRequired($this->validationRules()['money']),
            'draft_rate'    => $this->isRequired($this->validationRules()['money']),
            'country_id'    => $this->isRequired($this->validationRules()['id']),
            'is_active'     => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
