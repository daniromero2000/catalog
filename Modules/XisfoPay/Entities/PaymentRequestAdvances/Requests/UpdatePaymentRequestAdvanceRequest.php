<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvances\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePaymentRequestAdvanceRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'image.*' => $this->isRequired($this->validationRules()['pdf_image']),
            'value'   => $this->isRequired($this->validationRules()['money'])
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
