<?php

namespace Modules\CamStudio\Entities\CammodelFines\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCammodelFineRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'cammodel_id' => $this->isRequired($this->validationRules()['id']),
            'foul_id'     => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [
            'foul_id.required' => 'Se debe seleccionar un valor para el campo de Falta'
        ];
    }
}
