<?php

namespace Modules\Generals\Entities\Schedulers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateSchedulerRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'employee_id' => $this->isRequired($this->validationRules()['id']),
            'date'        => ['required'],
            'time'        => ['required'],
            'title'       => ['required']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
