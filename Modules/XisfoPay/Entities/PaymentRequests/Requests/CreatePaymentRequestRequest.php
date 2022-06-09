<?php

namespace Modules\XisfoPay\Entities\PaymentRequests\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePaymentRequestRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'usd_amount'                         => $this->isRequired($this->validationRules()['money']),
            'contract_request_stream_account_id' => $this->isRequired($this->validationRules()['id']),
            'image.*'                            => $this->isRequired($this->validationRules()['pdf_image'])
        ];
    }

    public function messages(): array
    {
        return [
            'image.file'  => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'image.mimes' => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'image.max'   => 'El tamaño del grupo de archivos no puede exceder los 10MB'
        ];
    }
}
