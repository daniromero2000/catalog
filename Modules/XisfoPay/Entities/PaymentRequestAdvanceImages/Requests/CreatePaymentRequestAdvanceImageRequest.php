<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentRequestAdvanceImageRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'payment_request_advance_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
