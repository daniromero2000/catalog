<?php

namespace Modules\Ecommerce\Entities\Carts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class StripeExecutionRequest extends BaseFormRequest implements CheckoutInterface
{
    public function rules(): array
    {
        return [
            'stripeToken' => ['required'],
            'billing_address' => ['required']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
