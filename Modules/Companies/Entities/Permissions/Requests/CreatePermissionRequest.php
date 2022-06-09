<?php

namespace Modules\Companies\Entities\Permissions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePermissionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'         => $this->isUnique($this->isRequired($this->validationRules()['profiles']), 'permissions'),
            'display_name' => $this->isUnique($this->isRequired($this->validationRules()['person_names']), 'permissions'),
            'icon'         => $this->isRequired($this->validationRules()['icons']),
            'description'  => $this->isRequired($this->validationRules()['text'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
