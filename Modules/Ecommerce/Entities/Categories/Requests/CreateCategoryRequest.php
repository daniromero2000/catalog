<?php

namespace Modules\Ecommerce\Entities\Categories\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCategoryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'   => $this->isUnique($this->isRequired($this->validationRules()['commercial_names']), 'categories'),
            'cover'  => $this->validationRules()['image'],
            'banner' => $this->validationRules()['image']
        ];
    }

    public function messages(): array
    {
        return [
            'cover.file'  => 'Se debe adjuntar un archivo tipo imagen',
            'cover.max'   => 'El tamaño del archivo no puede exceder 1MB',
            'banner.file' => 'Se debe adjuntar un archivo tipo imagen',
            'banner.max'  => 'El tamaño del archivo no puede exceder 1MB'
        ];
    }
}
