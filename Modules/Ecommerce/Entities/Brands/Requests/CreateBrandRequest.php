<?php

namespace Modules\Ecommerce\Entities\Brands\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateBrandRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'brands', 'name')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
