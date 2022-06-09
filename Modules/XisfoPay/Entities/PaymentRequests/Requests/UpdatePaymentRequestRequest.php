<?php

namespace Modules\XisfoPay\Entities\PaymentRequests\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePaymentRequestRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'image.*'    => $this->isRequired($this->validationRules()['pdf_image']),
            'usd_amount' => $this->validationRules()['money']

        ];
    }

    public function messages(): array
    {
        return [
            'image.file'                 => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'image.mimes'                => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'image.max'                  => 'El tamaño del grupo de archivos no puede exceder los 10MB',
            'chase_transfer_id.required' => 'Debes seleccionar un Giro'
        ];
    }
}
