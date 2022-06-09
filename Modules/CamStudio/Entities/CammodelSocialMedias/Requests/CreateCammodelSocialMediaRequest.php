<?php

namespace Modules\CamStudio\Entities\CammodelSocialMedias\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCammodelSocialMediaRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'profile'            => $this->isRequired($this->validationRules()['profiles']),
            'user'               => $this->isRequired($this->validationRules()['profiles']),
            'password'           => $this->isRequired($this->validationRules()['passwords']),
            'corporate_phone_id' => $this->isRequired($this->validationRules()['id']),
            'cammodel_id'        => $this->isRequired($this->validationRules()['id']),
            'social_media_id'    => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [
            'corporate_phone_id.required' => 'Se requiere un número telefónico asociado o seleccione la opción "Sin Teléfono"'
        ];
    }
}
