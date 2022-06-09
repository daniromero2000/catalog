<?php

namespace Modules\Generals\Entities\EconomicActivityTypes\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateEconomicActivityTypeRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'economic_activity_type' => ['required']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
