<?php

namespace Modules\XisfoPay\Entities\PaymentRequestCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentRequestCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'commentary'         => $this->isRequired($this->validationRules()['text']),
            'payment_request_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
