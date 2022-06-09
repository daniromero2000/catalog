<?php

namespace Modules\Streamings\Entities\Streamings\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateStreamingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'streaming' => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'streamings'),
            'url'       => $this->isRequired($this->validationRules()['routes'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
