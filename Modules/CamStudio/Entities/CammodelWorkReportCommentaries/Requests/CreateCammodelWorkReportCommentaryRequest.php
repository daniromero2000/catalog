<?php

namespace  Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCammodelWorkReportCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'commentary'              => $this->isRequired($this->validationRules()['text']),
            'cammodel_work_report_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [
            'cammodel_work_report_id.required' => 'El comentario debe ir relacionado a un Registro de turno'
        ];
    }
}
