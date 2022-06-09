<?php

namespace Modules\PawnShop\Entities\FasecoldaPriceRates\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateFasecoldaPriceRateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' =>  $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'fasecolda_price_rates')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
