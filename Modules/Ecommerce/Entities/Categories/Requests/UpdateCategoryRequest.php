<?php

namespace Modules\Ecommerce\Entities\Categories\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'   => $this->isUniqueForUpdate($this->isRequired($this->validationRules()['commercial_names']), 'categories', 'name'),
            'cover'  => $this->isRequired($this->validationRules()['image']),
            'banner' => $this->isRequired($this->validationRules()['image'])
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
