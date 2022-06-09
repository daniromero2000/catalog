<?php

namespace Modules\CamStudio\Entities\CammodelTippers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCammodelTipperRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'profile'      => $this->isRequired($this->validationRules()['profiles']),
            'streaming_id' => $this->isRequired($this->validationRules()['id']),
            'nickname'     => $this->isRequired($this->validationRules()['profiles']),
            'birthday'     => $this->validationRules()['dates'],
            'location'     => $this->validationRules()['string']
        ];
    }

    public function messages(): array
    {
        return [
            'birthday.date'         => 'No es válida la fecha ingresada',
            'location.string'       => 'No es válida la ubicación ingresada'
        ];
    }
}
