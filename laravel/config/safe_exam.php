<?php

return [
    'token_bytes' => env('SAFE_EXAM_TOKEN_BYTES', 8),
    'quit_password_bytes' => env('SAFE_EXAM_QUIT_PASSWORD_BYTES', 2),
    'registration_enabled' => env('SAFE_EXAM_REGISTRATION_ENABLED', false),
    'password_reset_enabled' => env('SAFE_EXAM_PASSWORD_RESET_ENABLED', false),
];
