<?php

namespace Modules\PawnShop\Entities\FasecoldaPriceRates\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateFasecoldaPriceRateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
