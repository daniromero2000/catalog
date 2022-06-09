<?php

namespace Modules\Customers\Entities\LeadReasons\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateLeadReasonRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'reason'     => $this->isRequired($this->validationRules()['string']),
            'company_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
