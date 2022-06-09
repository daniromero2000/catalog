<?php

namespace Modules\PawnShop\Entities\PawnItemCategories\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePawnItemCategoryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'pawn_item_categories')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
