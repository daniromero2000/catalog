<?php

namespace Modules\Pqrs\Entities\PqrCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePqrCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'pqr_id'     => $this->isRequired($this->validationRules()['id']),
            'commentary' => $this->isRequired($this->validationRules()['text']),
            'user'       => $this->isRequired($this->validationRules()['person_names'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
