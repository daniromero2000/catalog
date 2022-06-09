<?php

namespace Modules\XisfoPay\Entities\ContractRenewals\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateContractRenewalRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'file' => $this->isRequired($this->validationRules()['pdf_image'])
        ];
    }

    public function messages(): array
    {
        return [
            'file.file' => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'file.max'  => 'El tamaño del archivo no puede exceder los 10MB',
            'file.mimes' => 'Se debe adjuntar un archivo tipo imagen o PDF'
        ];
    }
}
