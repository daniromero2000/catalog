<?php

namespace Modules\Customers\Entities\CustomerBankAccounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerBankAccountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
