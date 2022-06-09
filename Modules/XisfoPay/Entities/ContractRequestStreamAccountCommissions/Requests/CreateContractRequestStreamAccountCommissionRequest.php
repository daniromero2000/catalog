<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractRequestStreamAccountCommissionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'streaming_id' => $this->isRequired($this->validationRules()['id']),
            'amount'       => $this->isRequired($this->validationRules()['money'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
