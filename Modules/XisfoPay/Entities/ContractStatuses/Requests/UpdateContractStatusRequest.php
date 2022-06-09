<?php

namespace Modules\XisfoPay\Entities\ContractStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;


class UpdateContractStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'      => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'contract_statuses', 'name'),
            'color'     => $this->isRequired($this->validationRules()['colors']),
            'is_active' => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
