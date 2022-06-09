<?php

namespace Modules\CamStudio\Entities\CammodelSocialMedias\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCammodelSocialMediaRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'profile'         => $this->isRequired($this->validationRules()['profiles']),
            'user'            => $this->isRequired($this->validationRules()['profiles']),
            'password'        => $this->isRequired($this->validationRules()['passwords']),
            'cammodel_id'     => $this->isRequired($this->validationRules()['id']),
            'social_media_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}