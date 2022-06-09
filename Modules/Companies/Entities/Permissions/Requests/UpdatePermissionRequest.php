<?php

namespace Modules\Companies\Entities\Permissions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePermissionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'         => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['profiles']), 'permissions', 'name'),
            'display_name' => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['person_names']), 'permissions', 'display_name'),
            'icon'         => $this->isRequired($this->validationRules()['icons']),
            'description'  => $this->isRequired($this->validationRules()['text'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
