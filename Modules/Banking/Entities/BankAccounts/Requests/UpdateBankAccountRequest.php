<?php

namespace Modules\Banking\Entities\BankAccounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateBankAccountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'amount'       => $this->isRequired($this->validationRules()['money']),
            'bank_id'      => $this->isRequired($this->validationRules()['id']),
            'account_type' => $this->isRequired($this->validationRules()['string']),
            'description'  => $this->validationRules()['text']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
