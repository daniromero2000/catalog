<?php

namespace  Modules\CamStudio\Entities\CamstudioReportCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCamstudioReportCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'commentary'  => $this->isRequired($this->validationRules()['text'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
