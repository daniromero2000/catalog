<?php

namespace Modules\XisfoPay\Entities\ChaseTransfers\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateChaseTransferRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'chase_transfer_trm_id' => $this->isRequired($this->validationRules()['id']),
            'transfer_amount'       => $this->isRequired($this->validationRules()['money'])
        ];
    }

    public function messages(): array
    {
        return [
            'chase_transfer_trm_id.required' => 'Debe seleccionar un valor de TRM',
            'chase_transfer_trm_id.numeric'  => 'La TRM seleccionada no es válida',
            'transfer_amount.required'    => 'Debe ingresar un monto',
            'transfer_amount.numeric'     => 'El monto ingresado no es válido'
        ];
    }
}
