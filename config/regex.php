<?php

return [
    'alpha_space' => '/^[\pL\s]+$/u',
    'alpha_num_space' => '/^[\pL\d\s]+$/u',
    'password_format' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/'
];
