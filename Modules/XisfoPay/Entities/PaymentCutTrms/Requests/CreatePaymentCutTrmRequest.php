<?php

namespace Modules\XisfoPay\Entities\PaymentCutTrms\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentCutTrmRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'trm'     => $this->isRequired($this->validationRules()['money']),
            'bank_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
