<?php

namespace Modules\Generals\Entities\EconomicActivityTypes\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateEconomicActivityTypeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'economic_activity_type' => ['required', 'unique:economic_activity_types']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
