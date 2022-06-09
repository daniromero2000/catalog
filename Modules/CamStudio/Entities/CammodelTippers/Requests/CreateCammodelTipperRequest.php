<?php

namespace Modules\CamStudio\Entities\CammodelTippers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCammodelTipperRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'profile'      => $this->isRequired($this->validationRules()['profiles']),
            'streaming_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
