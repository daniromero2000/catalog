<?php

namespace Modules\CamStudio\Entities\CammodelStreamAccounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCammodelStreamAccountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'profile'      => $this->isRequired($this->validationRules()['profiles']),
            'user'         => $this->isRequired($this->validationRules()['profiles']),
            'password'     => $this->isRequired($this->validationRules()['passwords']),
            'streaming_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
