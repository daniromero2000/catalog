<?php

namespace Modules\Companies\Entities\Employees\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateEmployeeProfileRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'password'         => $this->isRequired($this->validationRules()['passwords']),
            'confirm_password' => $this->isRequired($this->validationRules()['confirm_passwords'])
        ];
    }

    public function messages(): array
    {
        return [
            'confirm_password.required' => 'Se requiere confirmar la contraseña',
            'confirm_password.same'     => 'Se requiere confirmar la contraseña'
        ];
    }
}
