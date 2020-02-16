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

    'accepted'                  => '형태 :attribute 받아 들여 져야한다.',
    'active_url'                => '형태 :attribute 유효한 URL이 아닙니다.',
    'after'                     => '형태 :attribute 이후 날짜 여야합니다 :date.',
    'after_or_equal'            => '형태 :attribute 이후의 날짜 여야합니다 :date.',
    'alpha'                     => '형태 :attribute 문자 만 포함 할 수 있습니다.',
    'alpha_dash'                => '형태 :attribute 문자, 숫자, 대시 및 밑줄 만 포함 할 수 있습니다.',
    'alpha_num'                 => '형태 :attribute 문자와 숫자 만 포함 할 수 있습니다.',
    'array'                     => '형태 :attribute 배열이어야합니다.',
    'before'                    => '형태 :attribute 이전 날짜 여야합니다 :date.',
    'before_or_equal'           => '형태 :attribute 날짜 이전이어야합니다 :date.',
    'between' => [
        'numeric'               => '형태 :attribute 사이에 있어야합니다 :min 과 :max.',
        'file'                  => '형태 :attribute 사이에 있어야합니다 :min 과 :max 킬로바이트.',
        'string'                => '형태 :attribute 사이에 있어야합니다 :min 과 :max 문자.',
        'array'                 => '형태 :attribute 사이에 있어야합니다 :min 과 :max 아이템.',
    ],
    'boolean'                   => '형태 :attribute 필드는 true 또는 false 여야합니다.',
    'confirmed'                 => '형태 :attribute 확인이 일치하지 않습니다.',
    'date'                      => '형태 :attribute 유효한 날짜가 아닙니다.',
    'date_equals'               => '형태 :attribute 날짜와 같아야합니다 :date.',
    'date_format'               => '형태 :attribute does not match the format :format.',
    'different'                 => '형태 :attribute 과 :other must be different.',
    'digits'                    => '형태 :attribute must be :digits digits.',
    'digits_between'            => '형태 :attribute 사이에 있어야합니다 :min 과 :max digits.',
    'dimensions'                => '형태 :attribute has invalid image dimensions.',
    'distinct'                  => '형태 :attribute field has a duplicate value.',
    'email'                     => '형태 :attribute must be a valid email address.',
    'ends_with'                 => '형태 :attribute must end with one of the following: :values.',
    'exists'                    => '형태 selected :attribute is invalid.',
    'file'                      => '형태 :attribute must be a file.',
    'filled'                    => '형태 :attribute field must have a value.',
    'gt' => [
        'numeric'               => '형태 :attribute must be greater than :value.',
        'file'                  => '형태 :attribute must be greater than :value 킬로바이트.',
        'string'                => '형태 :attribute must be greater than :value characters.',
        'array'                 => '형태 :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric'               => '형태 :attribute must be greater than or equal :value.',
        'file'                  => '형태 :attribute must be greater than or equal :value 킬로바이트.',
        'string'                => '형태 :attribute must be greater than or equal :value characters.',
        'array'                 => '형태 :attribute must have :value items or more.',
    ],
    'image'                     => '형태 :attribute must be an image.',
    'in'                        => '형태 selected :attribute is invalid.',
    'in_array'                  => '형태 :attribute field does not exist in :other.',
    'integer'                   => '형태 :attribute must be an integer.',
    'ip'                        => '형태 :attribute must be a valid IP address.',
    'ipv4'                      => '형태 :attribute must be a valid IPv4 address.',
    'ipv6'                      => '형태 :attribute must be a valid IPv6 address.',
    'json'                      => '형태 :attribute must be a valid JSON string.',
    'lt' => [
        'numeric'               => '형태 :attribute must be less than :value.',
        'file'                  => '형태 :attribute must be less than :value 킬로바이트.',
        'string'                => '형태 :attribute must be less than :value characters.',
        'array'                 => '형태 :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric'               => '형태 :attribute must be less than or equal :value.',
        'file'                  => '형태 :attribute must be less than or equal :value 킬로바이트.',
        'string'                => '형태 :attribute must be less than or equal :value characters.',
        'array'                 => '형태 :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric'               => '형태 :attribute may not be greater than :max.',
        'file'                  => '형태 :attribute may not be greater than :max 킬로바이트.',
        'string'                => '형태 :attribute may not be greater than :max characters.',
        'array'                 => '형태 :attribute may not have more than :max items.',
    ],
    'mimes'                     => '형태 :attribute must be a file of type: :values.',
    'mimetypes'                 => '형태 :attribute must be a file of type: :values.',
    'min' => [
        'numeric'               => '형태 :attribute must be at least :min.',
        'file'                  => '형태 :attribute must be at least :min 킬로바이트.',
        'string'                => '형태 :attribute must be at least :min characters.',
        'array'                 => '형태 :attribute must have at least :min items.',
    ],
    'not_in'                    => '형태 selected :attribute is invalid.',
    'not_regex'                 => '형태 :attribute format is invalid.',
    'numeric'                   => '형태 :attribute must be a number.',
    'password'                  => '형태 password is incorrect.',
    'present'                   => '형태 :attribute field must be present.',
    'regex'                     => '형태 :attribute format is invalid.',
    'required'                  => '형태 :attribute field is required.',
    'required_if'               => '형태 :attribute field is required when :other is :value.',
    'required_unless'           => '형태 :attribute field is required unless :other is in :values.',
    'required_with'             => '형태 :attribute field is required when :values is present.',
    'required_with_all'         => '형태 :attribute field is required when :values are present.',
    'required_without'          => '형태 :attribute field is required when :values is not present.',
    'required_without_all'      => '형태 :attribute field is required when none of :values are present.',
    'same'                      => '형태 :attribute 과 :other must match.',
    'size' => [
        'numeric'               => '형태 :attribute must be :size.',
        'file'                  => '형태 :attribute must be :size 킬로바이트.',
        'string'                => '형태 :attribute must be :size characters.',
        'array'                 => '형태 :attribute must contain :size items.',
    ],
    'starts_with'               => '형태 :attribute must start with one of the following: :values.',
    'string'                    => '형태 :attribute must be a string.',
    'timezone'                  => '형태 :attribute must be a valid zone.',
    'unique'                    => '형태 :attribute has already been taken.',
    'uploaded'                  => '형태 :attribute failed to upload.',
    'url'                       => '형태 :attribute format is invalid.',
    'uuid'                      => '형태 :attribute must be a valid UUID.',

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

    'attributes' => [],

];
