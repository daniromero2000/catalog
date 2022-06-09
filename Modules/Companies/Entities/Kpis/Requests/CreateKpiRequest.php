<?php

namespace Modules\Companies\Entities\Kpis\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateKpiRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'subsidiary_id'      => $this->isRequired($this->validationRules()['id']),
            'min_fortnight_goal' => $this->isRequired($this->validationRules()['numeric'])
        ];
    }

    public function messages(): array
    {
        return [
            'min_fortnight_goal.required' => 'Debe ingresar un valor de meta mínima quincenal',
            'min_fortnight_goal.numeric'  => 'El valor de la meta mínima quincenal debe ser un número'
        ];
    }
}
