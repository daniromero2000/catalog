<?php

namespace Modules\Pqrs\Entities\Pqrs\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePqrRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'name'  => $this->isRequired($this->validationRules()['person_names']),
            'email' => $this->isRequired($this->validationRules()['emails'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
