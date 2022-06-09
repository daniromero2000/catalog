<?php

namespace Modules\Ecommerce\Entities\Couriers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCourierRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'couriers'),
            'cost' => ['required_if:is_free,0']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
