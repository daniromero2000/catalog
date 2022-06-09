<?php

namespace Modules\CamStudio\Entities\CammodelWorkReports\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCammodelWorkReportRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'shift_id'    => $this->isRequired($this->validationRules()['id']),
            'cammodel_id' => $this->isRequired($this->validationRules()['id']),
            'entry_time'  => $this->isRequired($this->validationRules()['times'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
