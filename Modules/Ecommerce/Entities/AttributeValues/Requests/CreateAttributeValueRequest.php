<?php

namespace Modules\Ecommerce\Entities\AttributeValues\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateAttributeValueRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'value' => ['required', 'unique:attribute_values', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'value.unique'   => 'Ya existe un valor de atributo con este nombre',
            'value.required' => 'Se requiere de un nombre para el valor de atributo'
        ];
    }
}
