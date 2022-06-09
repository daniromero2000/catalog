<?php

namespace Modules\Companies\Entities\Roles\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateRoleRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'roles' => $this->validationRules()['arrays']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
