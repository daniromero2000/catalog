<?php

namespace Modules\Customers\Entities\CustomerIdentities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCustomerIdentityRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'file' => $this->validationRules()['file']
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
