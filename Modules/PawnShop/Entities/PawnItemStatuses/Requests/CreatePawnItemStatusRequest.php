<?php

namespace Modules\PawnShop\Entities\PawnItemStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePawnItemStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'  => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'pawn_item_statuses'),
            'color' => $this->isRequired($this->validationRules()['colors'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
