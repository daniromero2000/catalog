<?php

namespace Modules\Ecommerce\Entities\Couriers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCourierRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'couriers', 'name')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
