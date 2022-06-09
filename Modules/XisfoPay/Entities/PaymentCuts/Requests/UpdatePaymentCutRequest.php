<?php

namespace Modules\XisfoPay\Entities\PaymentCuts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePaymentCutRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'is_aprobed' => $this->isRequired($this->validationRules()['status'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
