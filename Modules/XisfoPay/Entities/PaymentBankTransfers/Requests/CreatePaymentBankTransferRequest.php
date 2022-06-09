<?php

namespace Modules\XisfoPay\Entities\PaymentBankTransfers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentBankTransferRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'value'              => $this->isRequired($this->validationRules()['money']),
            'payment_request_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }
}
