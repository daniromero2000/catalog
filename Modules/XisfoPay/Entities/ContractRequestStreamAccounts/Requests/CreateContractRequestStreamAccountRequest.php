<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractRequestStreamAccountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'nickname'            => $this->isRequired($this->validationRules()['profiles']),
            'streaming_id'        => $this->isRequired($this->validationRules()['id']),
            'contract_request_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
