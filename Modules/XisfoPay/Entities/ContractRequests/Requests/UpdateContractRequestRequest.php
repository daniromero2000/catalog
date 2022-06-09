<?php

namespace Modules\XisfoPay\Entities\ContractRequests\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateContractRequestRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'contract_request_status_id' => $this->isRequired($this->validationRules()['id']),
            'file'                       => $this->validationRules()['pdf_image']
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
