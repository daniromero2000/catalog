<?php

namespace Modules\XisfoPay\Entities\XisfoServices\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateXisfoServiceRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'xisfo_services', 'name')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
