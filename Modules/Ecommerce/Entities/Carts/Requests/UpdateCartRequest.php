<?php

namespace Modules\Ecommerce\Entities\Carts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCartRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'quantity' => $this->isRequired($this->validationRules()['quantities'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
