<?php

namespace Modules\Ecommerce\Entities\OrderStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateOrderStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'      => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'order_statuses', 'name'),
            'color'     => $this->isRequired($this->validationRules()['colors']),
            'is_active' => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
