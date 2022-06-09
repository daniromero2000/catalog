<?php

namespace Modules\Generals\Entities\PopUp\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePopUpRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:PopUp'],
            'cover' => $this->isRequired($this->validationRules()['image'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
