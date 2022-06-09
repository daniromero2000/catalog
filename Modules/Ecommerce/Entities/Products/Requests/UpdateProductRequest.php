<?php

namespace Modules\Ecommerce\Entities\Products\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateProductRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'cover'    => $this->validationRules()['image'],
            'image.*'  => $this->validationRules()['images']
        ];
    }

    public function messages(): array
    {
        return [
            'cover.file'   => 'Se debe adjuntar un archivo tipo imagen',
            'cover.max'    => 'El tamaño del archivo no puede exceder 1MB',
            'cover.mimes'   => 'Se debe adjuntar un archivo tipo imagen',
            'image.*.file' => 'Se debe adjuntar archivos tipo imagen',
            'image.*.max'  => 'El tamaño del grupo de archivos no puede exceder los 10MB',
            'image.*.mimes'   => 'Se debe adjuntar un archivo tipo imagen'
        ];
    }
}
