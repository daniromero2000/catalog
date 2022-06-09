<?php

namespace Modules\CamStudio\Entities\StreamingStats\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateStreamingStatRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'cammodel_stream_account_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
