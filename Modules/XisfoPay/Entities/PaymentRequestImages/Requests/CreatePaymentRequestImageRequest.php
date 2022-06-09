<?php

namespace Modules\XisfoPay\Entities\PaymentRequestImages\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentRequestImageRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'payment_request_id' => $this->isRequired($this->validationRules()['id']),
            'file'               => $this->isRequired($this->validationRules()['pdf_image'])
        ];
    }

    public function messages(): array
    {
        return [
            'file.file'      => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'file.mimes'      => 'Se debe adjuntar un archivo tipo imagen o PDF'
        ];
    }
}
