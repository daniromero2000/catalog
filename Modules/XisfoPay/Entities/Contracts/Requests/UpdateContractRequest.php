<?php

namespace Modules\XisfoPay\Entities\Contracts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateContractRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'contract_status_id' => $this->isRequired($this->validationRules()['id']),
            'is_active'          => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
