<?php

namespace Modules\Companies\Entities\Actions\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateActionRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['person_names']), 'actions', 'name'),
            'icon'          => $this->isRequired($this->validationRules()['icons']),
            'permission_id' => $this->isRequired($this->validationRules()['id']),
            'principal'     => $this->isRequired($this->validationRules()['status']),
            'route'         => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['routes']), 'actions', 'route')
        ];
    }

    public function messages(): array
    {
        return [
            'principal.required'     => 'Debe seleccionar si la acción se muestra o no en la sidebar'
        ];
    }
}
