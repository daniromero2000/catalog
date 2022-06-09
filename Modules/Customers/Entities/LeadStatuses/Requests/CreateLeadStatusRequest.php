<?php

namespace Modules\Customers\Entities\LeadStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateLeadStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'  => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'lead_statuses'),
            'color' => $this->isRequired($this->validationRules()['colors'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
