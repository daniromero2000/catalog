<?php

namespace Modules\Ecommerce\Entities\Carts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CartCheckoutRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'billing_address' => ['required']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
