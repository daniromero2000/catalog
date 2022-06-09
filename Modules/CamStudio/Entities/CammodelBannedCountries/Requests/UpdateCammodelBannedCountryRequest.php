<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCammodelBannedCountryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'country_id'  => $this->isRequired($this->validationRules()['id']),
            'cammodel_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
