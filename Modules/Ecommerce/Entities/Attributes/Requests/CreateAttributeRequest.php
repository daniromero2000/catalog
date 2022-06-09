<?php

namespace Modules\Ecommerce\Entities\Attributes\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateAttributeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' =>  $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'attributes')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
