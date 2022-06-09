<?php

namespace Modules\Banking\Entities\Banks\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateBankRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'banks', 'name'),
            'transfer_rate' => $this->isRequired($this->validationRules()['money']),
            'draft_rate'    => $this->isRequired($this->validationRules()['money']),
            'is_active'     => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
