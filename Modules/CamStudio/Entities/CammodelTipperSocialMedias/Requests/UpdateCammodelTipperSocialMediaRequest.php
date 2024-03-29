<?php

namespace Modules\CamStudio\Entities\CammodelTipperSocialMedias\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCammodelTipperSocialMediaRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'profile'            => $this->isRequired($this->validationRules()['profiles']),
            'social_media_id'    => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
