<?php

namespace Modules\XisfoPay\Entities\ContractRates\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateContractRateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'percentage' => ['max:255', 'bail', 'string'],
            'type'       => ['required', 'bail', 'max:1', 'integer'],
            'value'      => ['required', 'bail', 'numeric'],
            'is_aprobed' => $this->isRequired($this->validationRules()['status']),
            'is_active'  => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
