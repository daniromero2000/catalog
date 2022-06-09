<?php

namespace Modules\Companies\Entities\Shifts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateShiftRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'   => $this->isRequired($this->validationRules()['person_names']),
            'starts' => $this->isRequired($this->validationRules()['times'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
