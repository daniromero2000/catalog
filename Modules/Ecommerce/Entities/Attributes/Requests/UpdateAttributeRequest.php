<?php

namespace Modules\Ecommerce\Entities\Attributes\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateAttributeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'      => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'attributes', 'name'),
            'is_active' => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
