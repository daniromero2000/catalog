<?php

namespace Modules\Ecommerce\Entities\ProductReviews\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateOrderShippingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'rating'      => $this->isRequired($this->validationRules()['ratings']),
            'product_id'  => $this->isRequired($this->validationRules()['id']),
            'customer_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
