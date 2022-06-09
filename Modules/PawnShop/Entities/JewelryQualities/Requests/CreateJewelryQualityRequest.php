<?php

namespace Modules\PawnShop\Entities\JewelryQualities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateJewelryQualityRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:jewelry_qualities']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
