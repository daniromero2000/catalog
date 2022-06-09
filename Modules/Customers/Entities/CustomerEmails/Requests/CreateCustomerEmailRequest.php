<?php

namespace Modules\Customers\Entities\CustomerEmails\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerEmailRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'customer_id' => $this->isRequired($this->validationRules()['id']),
            'email'       => $this->isUnique($this->isRequired($this->validationRules()['emails']), 'customer_emails')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
