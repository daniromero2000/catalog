<?php

namespace Modules\PawnShop\Entities\PawnItemImages\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreatePawnItemImageRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'payment_item_id' => $this->isRequired($this->validationRules()['id']),
            'file'            => $this->validationRules()['pdf_image']
        ];
    }

    public function messages(): array
    {
        return [
            'file.file'      => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'file.mimes'      => 'Se debe adjuntar un archivo tipo imagen o PDF'
        ];
    }
}
