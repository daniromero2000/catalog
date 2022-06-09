<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateContractRequestStreamAccountCommissionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'amount' => $this->isRequired($this->validationRules()['money'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
