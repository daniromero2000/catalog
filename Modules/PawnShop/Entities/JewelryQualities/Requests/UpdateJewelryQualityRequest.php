<?php

namespace Modules\PawnShop\Entities\JewelryQualities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;


class UpdateJewelryQualityRequest extends BaseFormRequest
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
