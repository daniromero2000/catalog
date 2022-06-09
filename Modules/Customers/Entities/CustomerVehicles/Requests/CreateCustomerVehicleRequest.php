<?php

namespace Modules\Customers\Entities\CustomerVehicles\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerVehicleRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'vehicle_type_id'  => $this->isRequired($this->validationRules()['id']),
            'vehicle_brand_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
