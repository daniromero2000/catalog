<?php

namespace Modules\CamStudio\Entities\Rooms\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateRoomRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => $this->isRequired($this->validationRules()['commercial_names']),
            'subsidiary_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
