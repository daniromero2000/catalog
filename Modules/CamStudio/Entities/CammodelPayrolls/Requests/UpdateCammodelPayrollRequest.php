<?php

namespace Modules\CamStudio\Entities\CammodelPayrolls\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCammodelPayrollRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'trm' => $this->isRequired($this->validationRules()['money'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
