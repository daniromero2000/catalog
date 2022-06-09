<?php

namespace Modules\XisfoPay\Entities\ContractRequestCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractRequestCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'commentary'          => $this->isRequired($this->validationRules()['text']),
            'contract_request_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
