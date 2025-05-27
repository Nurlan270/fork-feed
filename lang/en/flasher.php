<?php

return [
    //  Authentication
    'auth' => [
        'success' => [
            'register' => 'Authentication successful. Please check your inbox to verify email',
            'login' => 'Authentication successful'
        ],
        'error' => 'Authentication failed. Please try again',
    ],
    'email' => [
        'success' => 'Email verified successfully',
        'sent' => 'Email verification link sent to your email address. Please check your inbox',
    ],
    'logout' => 'Logged out',
    'invalid_credentials' => 'Invalid credentials',

    //  Recipe
    'recipe' => [
        'created' => 'Recipe created',
        'updated' => 'Recipe updated',
        'deleted' => 'Recipe deleted'
    ],
];
