<?php

namespace  Modules\Companies\Entities\InterviewCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateInterviewCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'interview_id' => $this->isRequired($this->validationRules()['id']),
            'commentary'   => $this->isRequired($this->validationRules()['text'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
