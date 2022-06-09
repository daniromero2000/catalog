<?php

namespace Modules\XisfoPay\Entities\PaymentRequests\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class ApprovePaymentRequestRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'chase_transfer_id'                  => $this->isRequired($this->validationRules()['id']),
            'payments'                           => ['required', 'bail', 'array']
        ];
    }

    public function messages(): array
    {
        return [
        ];
    }
}
