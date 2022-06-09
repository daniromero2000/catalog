<?php

namespace Modules\CamStudio\Entities\CammodelWorkReports\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCammodelWorkReportRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'connection_time'  => $this->isRequired($this->validationRules()['times'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
