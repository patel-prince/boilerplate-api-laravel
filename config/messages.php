<?php

return [
    '500' => 'Internal Server Error!',
    '403' => 'Action is Unauthorized!',
    '404' => 'Not Found!',
    '401' => 'Token is invalid or expired.',
    'inactive_user' => 'User is not active at this time. Please contact your administrator for further query',
    'invalid_user' => 'User is not verified.',
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
        'send_email_verification_code' => [
            'success' => 'Email verification code has been sent successfully.',
            'already_verified' => 'Email ID is already verified. Please try to login.'
        ],
        'register_with_email' => 'Congratulations, you have successfully registered.',
        'verify_email' => 'Account has been verified.',
        'login_with_email' => [
            'unauthorized' => 'Email ID or Password is invalid.'
        ],
        'logout' => 'Successfully logged out'
    ]
];
