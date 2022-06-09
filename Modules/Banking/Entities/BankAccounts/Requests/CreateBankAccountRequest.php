<?php

namespace Modules\Banking\Entities\BankAccounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateBankAccountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'bank_id'        => $this->isRequired($this->validationRules()['id']),
            'name'           => $this->isRequired($this->validationRules()['string']),
            'account_number' => $this->isRequired($this->validationRules()['string'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
