<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentRequestStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'  => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'payment_request_statuses'),
            'color' => $this->isRequired($this->validationRules()['colors'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
