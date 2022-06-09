<?php

namespace Modules\Companies\Entities\Goals\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateGoalRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'usd_goal' => $this->isRequired($this->validationRules()['money']),
            'bonus'    => $this->isRequired($this->validationRules()['money'])
        ];
    }

    public function messages(): array
    {
        return [
            'usd_goal.between'  => 'La meta de dólares se sale del rango mínimo o máximo',
            'usd_goal.required' => 'Se debe ingresar un valor en el campo Meta en Dólares',
            'bonus.between'     => 'La bonificación se sale del rango mínimo o máximo',
            'bonus.required'    => 'Se debe ingresar un valor en el campo Bonificación'
        ];
    }
}
