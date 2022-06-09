<?php

namespace Modules\Ecommerce\Entities\Products\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'sku'      => ['required', 'bail', 'unique:products'],
            'name'     => ['required', 'bail', 'string'],
            'quantity' => $this->isRequired($this->validationRules()['quantities']),
            'price'    => $this->isRequired($this->validationRules()['money']),
            'cover'    => $this->validationRules()['image'],
            'image.*'  => $this->validationRules()['images']
        ];
    }

    public function messages(): array
    {
        return [
            'cover.file'   => 'Se debe adjuntar un archivo tipo imagen',
            'cover.max'    => 'El tamaño del archivo no puede exceder 1MB',
            'image.*.file' => 'Se debe adjuntar archivos tipo imagen',
            'image.*.max'  => 'El tamaño del grupo de archivos no puede exceder los 10MB'
        ];
    }
}
