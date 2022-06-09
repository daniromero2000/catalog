<?php

namespace Modules\XisfoPay\Entities\PaymentCuts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentCutRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
