<?php

namespace Modules\Companies\Entities\Roles\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateRoleRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'display_name' => $this->isUnique($this->isRequired($this->validationRules()['person_names']), 'roles'),
            'description'  => $this->isRequired($this->validationRules()['text'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
