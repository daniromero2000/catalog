<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractRequestStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'  => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'contract_request_statuses'),
            'color' => $this->isRequired($this->validationRules()['colors'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
