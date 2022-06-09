<?php

namespace Modules\XisfoPay\Entities\XisfoServices\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateXisfoServiceRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'xisfo_services')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
