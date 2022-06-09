<?php

namespace Modules\Pqrs\Entities\PqrStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePqrStatusRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'name'      => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'pqr_statuses', 'name'),
            'color'     => $this->isRequired($this->validationRules()['colors']),
            'is_active' => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
