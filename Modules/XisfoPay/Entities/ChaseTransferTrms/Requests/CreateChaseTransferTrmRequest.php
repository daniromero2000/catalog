<?php

namespace Modules\XisfoPay\Entities\ChaseTransferTrms\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateChaseTransferTrmRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'trm'     => ['required', 'bail', 'numeric'],
            'bank_id' => ['required', 'bail', 'numeric']
        ];
    }

    public function messages(): array
    {
        return [
            'trm.required' => 'Debe ingresar un valor de TRM',
            'trm.numeric' =>  'La TRM ingresada no es válida',
            'bank_id.required' => 'Debe seleccionar un banco',
            'bank_id.numeric' => 'El banco seleccionado no es válido'
        ];
    }
}
