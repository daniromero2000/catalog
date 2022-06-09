<?php

namespace Modules\Companies\Entities\Actions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateActionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isUnique($this->isRequired($this->validationRules()['person_names']), 'actions'),
            'icon'          => $this->isRequired($this->validationRules()['icons']),
            'permission_id' => $this->isRequired($this->validationRules()['id']),
            'principal'     => $this->isRequired($this->validationRules()['status']),
            'route'         => $this->isUnique($this->isRequired($this->validationRules()['routes']), 'actions')
        ];
    }

    public function messages(): array
    {
        return [
            'principal.required' => 'Debe seleccionar si la acción se muestra o no en la sidebar'
        ];
    }
}
