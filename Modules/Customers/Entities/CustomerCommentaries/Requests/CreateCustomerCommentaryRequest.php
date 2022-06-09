<?php

namespace  Modules\Customers\Entities\CustomerCommentaries\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerCommentaryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_id' => $this->isRequired($this->validationRules()['id']),
            'commentary'  => $this->isRequired($this->validationRules()['text'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
