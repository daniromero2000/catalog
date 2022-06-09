<?php

namespace Modules\CamStudio\Entities\Cammodels\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class UpdateCammodelRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'cover'      => $this->validationRules()['image'],
            'cover_page' => $this->validationRules()['image'],
            'image_tks'  => $this->validationRules()['image'],
            'image.*'    => $this->validationRules()['images']
        ];
    }

    public function messages(): array
    {
        return [
            'cover.file'      => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'cover.max'       => 'El tamaño del archivo no puede exceder 1MB',
            'cover_page.file' => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'cover_page.max'  => 'El tamaño del archivo no puede exceder 1MB',
            'image_tks.file'  => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'image_tks.max'   => 'El tamaño del archivo no puede exceder 1',
            'image.file'      => 'Se debe adjuntar un archivo tipo imagen o PDF',
            'image.max'       => 'El tamaño del grupo de archivos no puede exceder 1MB'
        ];
    }
}
