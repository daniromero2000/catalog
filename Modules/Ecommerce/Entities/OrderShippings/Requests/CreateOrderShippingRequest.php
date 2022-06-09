<?php

namespace Modules\Ecommerce\Entities\OrderShippings\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateOrderShippingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'order_id'   => $this->isRequired($this->validationRules()['id']),
            'courier_id' => $this->isRequired($this->validationRules()['id']),
            'total_qty'  => $this->isRequired($this->validationRules()['quantities'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
