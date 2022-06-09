<?php

namespace Modules\Ecommerce\Entities\OrderPayments\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateOrderPaymentRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
