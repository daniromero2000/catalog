<?php

namespace Modules\Customers\Entities\CustomerCompanies\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerCompanyRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'company_id_number' => $this->isUnique($this->isRequired($this->validationRules()['identities']), 'customer_companies')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
