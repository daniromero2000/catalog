<?php

namespace Modules\CamStudio\Entities\CammodelCategories\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'cammodel_categories', 'name')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
