<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateChaseTransferAmountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'chase_transfer_id' => $this->isRequired($this->validationRules()['id']),
            'streaming_id'      => $this->isRequired($this->validationRules()['id']),
            'amount'            => $this->isRequired($this->validationRules()['money'])
        ];
    }

    public function messages(): array
    {
        return [
            'chase_transfer_id.required' => 'Debe seleccionar una transferencia de Chase',
            'amount.required'            => 'Debe ingresar un monto',
            'chase_transfer_id.numeric'  => 'La tranferencia de Chase seleccionado no es válida',
            'amount.numeric'             => 'El monto ingresado no es válido'
        ];
    }
}
