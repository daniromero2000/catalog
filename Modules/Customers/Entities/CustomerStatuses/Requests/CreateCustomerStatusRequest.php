<?php

namespace Modules\Customers\Entities\CustomerStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'status' => $this->isRequired($this->validationRules()['status'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
