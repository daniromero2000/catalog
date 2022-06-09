<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvances\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentRequestAdvanceRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'value'              => $this->isRequired($this->validationRules()['money']),
            'payment_request_id' => $this->isRequired($this->validationRules()['id']),
            'image.*'            => $this->isRequired($this->validationRules()['pdf_image'])
        ];
    }

    public function messages(): array
    {
        return [
            'image.file' => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'image.max'  => 'El tamaño del grupo de archivos no puede exceder los 10MB',
            'image.mimes' => 'Se debe adjuntar un archivo tipo imagen o PDF'
        ];
    }
}
