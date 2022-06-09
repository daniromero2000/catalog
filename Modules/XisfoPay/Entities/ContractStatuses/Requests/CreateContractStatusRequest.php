<?php

namespace Modules\XisfoPay\Entities\ContractStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'  => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'contract_statuses'),
            'color' => $this->isRequired($this->validationRules()['colors'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
