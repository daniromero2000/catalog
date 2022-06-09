<?php

namespace Modules\XisfoPay\Entities\ContractRates\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateContractRateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'percentage' => ['required', 'string', 'bail', 'unique:contract_rates', 'max:255'],
            'type'       => ['required', 'bail', 'max:1', 'integer'],
            'value'      => ['required', 'bail', 'unique:contract_rates', 'numeric']
        ];
    }

    public function messages(): array
    {
        return [
            'percentage.unique' => 'Ya existe un procentaje registrado con este valor',
            'value.unique'      => 'Ya existe el valor'
        ];
    }
}
