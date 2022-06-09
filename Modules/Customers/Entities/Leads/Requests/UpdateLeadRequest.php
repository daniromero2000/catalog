<?php

namespace Modules\Customers\Entities\Leads\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateLeadRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'      => $this->isRequired($this->validationRules()['person_names']),
            'last_name' => $this->isRequired($this->validationRules()['person_names']),
            'phone'     => $this->isRequired($this->validationRules()['phones'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
