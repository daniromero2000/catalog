<?php

namespace Modules\PawnShop\Entities\PawnItems\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateItemAdminRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
