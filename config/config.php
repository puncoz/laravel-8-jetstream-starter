<?php

return [
    /**
     * No. of days before unverified user can use system without
     * email verification. '0' for restriction without verification.
     */
    'email_verification_period' => 7,

    'main_url'    => env('FRONT_URL', 'http://localhost'),
    'support_url' => env('SUPPORT_URL', ''),

    'developer' => [
        'name' => 'integrid.solutions',
        'link' => 'https://integrid.solutions',
    ],

    'copyright' => [
        'started_year' => '2020',
    ],
];
