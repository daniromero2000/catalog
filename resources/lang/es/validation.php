<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'attribute debe ser aceptado.',
    'active_url' => ':attribute no es una URL valida.',
    'after' => ':attribute debe ser una fecha después de :date.',
    'after_or_equal' => ':attribute debe ser una fecha después de o igual a :date.',
    'alpha' => ':attribute solo puede contener letras.',
    'alpha_dash' => ':attribute solo puede contener letras, números, guiones and y guiones bajos.',
    'alpha_num' => ':attribute solo puede contener letras y números.',
    'array' => ':attribute debe ser un array.',
    'before' => ':attribute debe ser una fecha antes de :date.',
    'before_or_equal' => ':attribute debe ser una fecha antes o igual a :date.',
    'between' => [
        'numeric' => ':attribute debe estar entre :min y :max.',
        'file' => ':attribute debe estar entre :min y :max kilobytes.',
        'string' => ':attribute debe tener entre :min y :max caracteres.',
        'array' => ':attribute debe tener entre :min y :max items.',
    ],
    'boolean' => 'El campo :attribute debe ser falso o verdadero.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => ':attribute no es una fecha valida.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => ':attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => ':attribute seleccionado es invalido.',
    'not_regex' => 'El formato de :attribute es invalido.',
    'numeric' => ':attribute debe ser un Número.',
    'password' => 'El password es Incorrecto.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'El formato del :attribute es invalido.',
    'required' => 'El campo :attribute es requerido.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'Ya existe un registro con este :attribute.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'phone'                => 'Número de Teléfono',
        'city_id'              => 'Ciudad',
        'name'                 => 'Nombre',
        'last_name'            => 'Apellido',
        'display_name'         => 'Nombre a Mostrar',
        'is_active'            => 'Estado',
        'transfer_rate'        => 'Tarifa de Transferencia',
        'draft_rate'           => 'Tarifa de Giro',
        'amount'               => 'Monto',
        'bank_id'              => 'Banco',
        'description'          => 'Descripción',
        'movement_type'        => 'Tipo de Movimiento',
        'country_id'           => 'País',
        'cammodel_id'          => 'Modelo',
        'profile'              => 'Perfíl',
        'user'                 => 'Usuario',
        'social_media_id'      => 'Red Social',
        'streaming_id'         => 'Plataforma',
        'birthday'             => 'Cumpleaños',
        'cammodel_tipper_id'   => 'Tipper',
        'commentary'           => 'Comentario',
        'shift_id'             => 'Turno',
        'connection_time'      => 'Hora Conexión',
        'entry_time'           => 'Entrada',
        'subsidiary_id'        => 'Sucursal',
        'permission_id'        => 'Permiso',
        'route'                => 'Ruta',
        'icon'                 => 'Icono',
        'disconnection_time'   => 'Hora Desconexión',
        'employee_id'          => 'Empleado',
        'stratum_id'           => 'Estrato',
        'address'              => 'Dirección',
        'housing_id'           => 'Tipo Vivienda',
        'eps_id'               => 'EPS',
        'customer_address'     => 'Dirección Cliente',
        'customer_identity_id' => 'Identidad Cliente',
        'file'                 => 'Archivo',
        'customer_id'          => 'Cliente',
        'streaming'            => 'Plataforma'
    ],
];
