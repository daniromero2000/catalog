<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateContractRequestStreamAccountRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            // 'is_active'    => $this->isRequired($this->validationRules()['is_active']),
            'set_up'       => $this->validationRules()['status'],
            'streaming_id' => $this->validationRules()['id']
        ];
    }

    public function messages(): array
    {
        return [
            'set_up.boolean' => 'El dato ingresado en el campo Configurado no es válido'
        ];
    }
}
