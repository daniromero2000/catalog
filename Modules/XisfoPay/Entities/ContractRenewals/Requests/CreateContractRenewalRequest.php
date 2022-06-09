<?php

namespace Modules\XisfoPay\Entities\ContractRenewals\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractRenewalRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'starts'           => $this->isRequired($this->validationRules()['dates']),
            'expires'          => $this->isRequired($this->validationRules()['dates']),
            'is_special_price' => $this->isRequired($this->validationRules()['status']),
            'contract_id'      => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
