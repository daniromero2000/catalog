<?php

namespace Modules\CamStudio\Entities\Fouls\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateFoulRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'   => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'fouls'),
            'charge' => $this->isRequired($this->validationRules()['money'])
        ];
    }

    public function messages(): array
    {
        return [
            'charge.between'  => 'La falta se sale del rango mínimo o máximo de cobro',
            'charge.required' => 'Se debe llenar el campo Costo'
        ];
    }
}
