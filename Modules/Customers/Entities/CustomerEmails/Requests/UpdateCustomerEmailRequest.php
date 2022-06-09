<?php

namespace Modules\Customers\Entities\CustomerEmails\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCustomerEmailRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => $this->isRequired($this->validationRules()['id']),
            'email'       => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['emails']), 'customer_emails', 'email')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
