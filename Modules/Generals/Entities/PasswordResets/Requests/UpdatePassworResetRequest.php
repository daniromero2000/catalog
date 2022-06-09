<?php

namespace Modules\Generals\Entities\PasswordResets\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdatePassworResetRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
