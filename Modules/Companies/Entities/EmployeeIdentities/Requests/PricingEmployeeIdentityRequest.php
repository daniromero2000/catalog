<?php

namespace Modules\Companies\Entities\EmployeeIdentities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class PricingEmployeeIdentityRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'employee_identity'  => $this->validationRules()['string']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
