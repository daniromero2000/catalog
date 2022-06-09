<?php

namespace Modules\Companies\Entities\InterviewStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateInterviewStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['person_names']), 'interview_statuses', 'name')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
