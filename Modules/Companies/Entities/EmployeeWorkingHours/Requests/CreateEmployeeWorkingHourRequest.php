<?php

namespace Modules\Companies\Entities\EmployeeWorkingHours\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEmployeeWorkingHourRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
