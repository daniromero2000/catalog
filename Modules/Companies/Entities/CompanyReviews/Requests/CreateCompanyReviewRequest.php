<?php

namespace Modules\Companies\Entities\CompanyReviews\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCompanyReviewRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'        => $this->isRequired($this->validationRules()['commercial_names']),
            'title'       => $this->isRequired($this->validationRules()['string']),
            'rating'      => $this->isRequired($this->validationRules()['ratings']),
            'comment'     => $this->isRequired($this->validationRules()['text']),
            'company_id'  => $this->isRequired($this->validationRules()['id']),
            'customer_id' => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'El Título es requerido',
            'title.regex'    => 'El Título tiene caracteres no permitidos'
        ];
    }
}
