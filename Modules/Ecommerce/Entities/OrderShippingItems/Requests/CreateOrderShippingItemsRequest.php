<?php

namespace Modules\Ecommerce\Entities\OrderShippingItems\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateOrderShippingItemsRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'sku'  => ['required'],
            'qty'  => $this->isRequired($this->validationRules()['quantities'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
