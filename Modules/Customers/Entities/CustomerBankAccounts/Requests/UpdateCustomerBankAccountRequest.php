<?php

namespace Modules\Customers\Entities\CustomerBankAccounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCustomerBankAccountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'file'                 => $this->validationRules()['file'],
            'customer_identity_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [
            'file.file'                     => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'file.max'                      => 'El tamaño del archivo no puede exceder los 10MB',
            'file.mimes'                    => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'customer_identity_id.required' => 'Debes Seleccionar una identidad para asociarla a la cuenta'
        ];
    }
}
