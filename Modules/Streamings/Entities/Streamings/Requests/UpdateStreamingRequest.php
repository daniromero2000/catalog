<?php

namespace Modules\Streamings\Entities\Streamings\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateStreamingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'streaming' => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'streamings', 'streaming'),
            'is_active' => $this->isRequired($this->validationRules()['is_active'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
