<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateChaseTransferAmountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'chase_transfer_id' => $this->isRequired($this->validationRules()['id']),
            'file'              => ['required', 'bail', 'file', 'mimes:xlsx']
        ];
    }

    public function messages(): array
    {
        return [
            'chase_transfer_id.required' => 'Debe seleccionar una transferencia de Chase',
            'chase_transfer_id.numeric'  => 'La tranferencia de Chase seleccionado no es válida'
        ];
    }
}
