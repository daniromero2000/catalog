<?php

namespace Modules\PawnShop\Entities\PawnItems\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePawnItemFrontRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
