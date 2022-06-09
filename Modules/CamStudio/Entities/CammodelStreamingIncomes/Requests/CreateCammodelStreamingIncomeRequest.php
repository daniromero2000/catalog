<?php

namespace Modules\CamStudio\Entities\CammodelStreamingIncomes\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCammodelStreamingIncomeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'disconnection_time'      => $this->isRequired($this->validationRules()['times']),
            'cammodel_work_report_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
