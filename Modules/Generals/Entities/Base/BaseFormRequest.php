<?php

namespace Modules\Generals\Entities\Base;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

abstract class BaseFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function validationRules(): array
    {
        return [
            'person_names'     => ['between:3,30', 'string', 'regex:/^[a-zA-ZÁÉÍÓÚáéíóúñÑ ]+$/u', 'bail'],
            'routes'           => ['between:3,30', 'string', 'regex:/^[a-zA-Z\-\.]+$/u', 'bail'],
            'icons'            => ['between:3,20', 'string', 'regex:/^[a-zA-Z\- ]+$/u', 'bail'],
            'commercial_names' => ['between:3,80', 'string', 'regex:/^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ&\. ]+$/u', 'bail'],
            'profiles'         => ['between:3,80', 'string', 'regex:/^[a-zA-Z0-9&_@\.\- ]+$/u', 'bail'],
            'addresses'        => ['between:3,80', 'string', 'regex:/^[a-zA-Z0-9&_@#\.\-\, ]+$/u', 'bail'],
            'colors'           => ['between:3,80', 'string', 'regex:/^[a-zA-Z0-9# ]+$/u', 'bail'],
            'emails'           => ['between:3,50', 'email', 'regex:/^[a-zA-Z0-9&_\-@\. ]+$/u', 'bail'],
            'money'            => ['numeric', 'between:0,2147483647', 'bail'],
            'numeric'          => ['numeric', 'between:0,2147483647', 'bail'],
            'quantities'       => ['integer', 'between:1,100', 'bail'],
            'phones'           => ['string', 'between:5,30', 'regex:/^[0-9]+$/u', 'bail'],
            'identities'       => ['string', 'between:5,20', 'regex:/^[0-9]+$/u', 'bail'],
            'id'               => ['integer', 'between:1,2147483647', 'bail'],
            'is_active'        => ['boolean', 'between:1,2', 'bail'],
            'status'           => ['boolean', 'between:1,2', 'bail'],
            'string'           => ['between:3,50', 'string', 'bail'],
            'rhs'              => ['between:2,2', 'string', 'bail'],
            'passwords'        => ['between:3,50', 'string', 'bail'],
            'confirm_passwords' => ['between:3,50', 'string', 'same:password', 'bail'],
            'text'             => ['min:3', 'string', 'bail'],
            'dates'            => ['date', 'bail'],
            'times'            => ['date_format:H:i', 'bail'],
            'ratings'          => ['numeric', 'between:0,5', 'bail'],
            'image'            => ['file', 'mimes:png,webp,jpeg,jpg,pdf,PNG', 'max:1024', 'bail'],
            'images'           => ['file', 'mimes:png,webp,jpeg,jpg,pdf,PNG', 'max:10240', 'bail'],
            'file'             => ['file', 'mimes:png,webp,jpeg,jpg,pdf', 'max:10240', 'bail'],
            'pdf_image'        => ['file', 'mimes:png,webp,jpeg,jpg,pdf', 'max:10240', 'bail'],
            'arrays'           => ['array', 'bail']
        ];
    }

    public function isRequired(array $data): array
    {
        array_push($data, 'required');
        return $data;
    }

    public function isUnique(array $data, string $table): array
    {
        array_push($data, 'unique:' . $table);
        return $data;
    }

    public function isUniqueForUpdate(array $data, string $table, string $column): array
    {
        array_push($data, Rule::unique($table, $column)->ignore($this->segment(3)));
        return $data;
    }
}
