<?php

return [
    '500' => 'Internal Server Error!',
    '403' => 'Action is Unauthorized!',
    '404' => 'Not Found!',
    'validation' => [
        'required' => ':attribute is required.',
        'alpha_space' => ':attribute may only contain letters and spaces.',
        'alpha_num_space' => ':attribute may only contain letters, numbers and spaces.',
        'email' => ':attribute must be a valid email address.',
        'unique' => ':attribute already exists.',
        'password_format' => ':attribute must contain at least 8 characters, including uppercase, lowercase letter, a number and special character.',
        'valid_hash_token' => ':attribute is invalid or expired.'
    ],
    'api' => [
        'register_with_email' => 'Congratulations, you have successfully registered.',
        'verify_email' => 'Account has been verified.'
    ]
];
