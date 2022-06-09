<?php

namespace  Modules\Ecommerce\Entities\OrderCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateOrderCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'order_id'   => $this->isRequired($this->validationRules()['id']),
            'commentary' => $this->isRequired($this->validationRules()['text'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
