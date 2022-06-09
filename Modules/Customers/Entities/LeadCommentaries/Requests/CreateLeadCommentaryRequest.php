<?php

namespace Modules\Customers\Entities\LeadCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateLeadCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'commentary' => $this->isRequired($this->validationRules()['text']),
            'lead_id'    => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
