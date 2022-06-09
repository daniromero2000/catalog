<?php

namespace Modules\Ecommerce\Entities\Carts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class PayPalCheckoutExecutionRequest extends BaseFormRequest implements CheckoutInterface
{
    public function rules(): array
    {
        return [
            'paymentId' => ['required'],
            'PayerID' => ['required'],
            'billing_address' => ['required'],
            'payment' => ['required']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
