<?php

namespace Modules\XisfoPay\Entities\PaymentBankTransfers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePaymentBankTransferRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'is_transfered' => $this->isRequired($this->validationRules()['status'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
