<?php

namespace Modules\XisfoPay\Entities\ChaseTransfers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateChaseTransferRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'is_approved' => $this->isRequired($this->validationRules()['status'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
