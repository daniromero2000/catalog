<?php

namespace Modules\XisfoPay\Entities\ContractRequestStatusesLogs\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractRequestStatusesLogRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'user'                => $this->isRequired($this->validationRules()['person_names']),
            'status'              => $this->isRequired($this->validationRules()['person_names']),
            'time_passed'         => $this->isRequired($this->validationRules()['string']),
            'contract_request_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
