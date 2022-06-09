<?php

namespace Modules\Ecommerce\Entities\AttributeValues\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateAttributeValueRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'bail']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
