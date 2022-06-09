<?php

namespace Modules\Customers\Entities\CustomerGroups\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateContractRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'contract_status_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
