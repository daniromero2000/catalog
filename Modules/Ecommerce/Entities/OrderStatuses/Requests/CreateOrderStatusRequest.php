<?php

namespace Modules\Ecommerce\Entities\OrderStatuses\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateOrderStatusRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'  => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'order_statuses'),
            'color' => $this->isRequired($this->validationRules()['colors'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
