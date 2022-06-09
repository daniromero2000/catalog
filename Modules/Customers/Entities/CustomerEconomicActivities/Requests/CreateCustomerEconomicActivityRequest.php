<?php

namespace Modules\Customers\Entities\CustomerEconomicActivities\Requests;

use Modules\Generals\Entities\Base\BaseFormRequest;

class CreateCustomerEconomicActivityRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'customer_id'               => $this->isRequired($this->validationRules()['id']),
            'economic_activity_type_id' => $this->isRequired($this->validationRules()['id']),
            'entity_name'               => $this->isRequired($this->validationRules()['commercial_names']),
            'professions_list_id'       => $this->isRequired($this->validationRules()['id']),
            'start_date'                => $this->isRequired($this->validationRules()['dates']),
            'incomes'                   => $this->isRequired($this->validationRules()['money']),
            'other_incomes'             => $this->isRequired($this->validationRules()['money']),
            'other_incomes_source'      => $this->isRequired($this->validationRules()['string']),
            'expenses'                  => $this->isRequired($this->validationRules()['money']),
            'entity_address'            => $this->isRequired($this->validationRules()['addresses']),
            'entity_phone'              => $this->isRequired($this->validationRules()['string']),
            'city_id'                   => $this->isRequired($this->validationRules()['id'])
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
