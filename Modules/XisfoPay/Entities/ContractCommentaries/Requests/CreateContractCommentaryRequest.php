<?php

namespace Modules\XisfoPay\Entities\ContractCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'commentary'  => $this->isRequired($this->validationRules()['text']),
            'contract_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
