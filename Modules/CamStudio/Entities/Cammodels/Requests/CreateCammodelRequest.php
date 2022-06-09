<?php

namespace Modules\CamStudio\Entities\Cammodels\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCammodelRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'employee_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
