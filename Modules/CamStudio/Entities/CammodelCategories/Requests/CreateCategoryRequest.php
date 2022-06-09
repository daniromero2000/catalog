<?php

namespace Modules\CamStudio\Entities\CammodelCategories\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCategoryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'cammodel_categories')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
