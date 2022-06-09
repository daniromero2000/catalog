<?php

namespace Modules\PawnShop\Entities\PawnItemCategories\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePawnItemCategoryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'pawn_item_categories', 'name')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
