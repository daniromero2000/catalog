<?php

namespace Modules\Companies\Entities\CorporatePhones\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCorporatePhonesRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'phone' => $this->isRequired($this->validationRules()['phones'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
