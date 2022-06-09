<?php

namespace Modules\Fasecolda\Entities\FasecoldaCodes\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateFasecoldaCodeRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'file' => ['bail', 'file']
        ];
    }

    public function messages(): array
    {
        return [
            'file.file' => 'Se debe adjuntar un archivo tipo CSV'
        ];
    }
}
