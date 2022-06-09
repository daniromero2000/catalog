<?php

namespace Modules\Companies\Entities\InterviewStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateInterviewStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => $this->isUnique($this->isRequired($this->validationRules()['person_names']), 'interview_statuses')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
