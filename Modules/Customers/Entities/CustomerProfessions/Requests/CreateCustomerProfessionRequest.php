<?php

namespace Modules\Customers\Entities\CustomerProfessions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerProfessionRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'professions_list_id' => $this->isRequired($this->validationRules()['id']),
            'customer_id'         => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
