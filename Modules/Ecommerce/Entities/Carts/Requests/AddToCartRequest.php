<?php

namespace Modules\Ecommerce\Entities\Carts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class AddToCartRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'product'  => $this->isRequired($this->validationRules()['id']),
            'quantity' => $this->isRequired($this->validationRules()['quantities'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
