<?php

namespace Modules\Pqrs\Entities\PqrStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePqrStatusRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'name'  => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'pqr_statuses'),
            'color' => $this->isRequired($this->validationRules()['colors'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
