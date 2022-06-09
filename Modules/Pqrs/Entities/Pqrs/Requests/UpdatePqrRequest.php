<?php

namespace Modules\Pqrs\Entities\Pqrs\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePqrRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'  => $this->isRequired($this->validationRules()['person_names'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
