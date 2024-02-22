<?php

return [
    'bot' => [
        'api_token' => env('TELEGRAM_API_TOKEN'),
        'username' => env('TELEGRAM_BOT_USERNAME', ''),
        'api_url' => env('TELEGRAM_API_URL'),
    ],

    'commands'     => [
        // Define all paths for your custom commands
        // DO NOT PUT THE COMMAND FOLDER THERE. IT WILL NOT WORK.
        // Copy each needed Commandfile into the CustomCommand folder and uncommend the Line 49 below
        'paths'   => [
             __DIR__ . '/CustomCommands',
        ],
        // Here you can set any command-specific parameters
        'configs' => [
            // - Google geocode/timezone API key for /date command (see DateCommand.php)
            // 'date'    => ['google_api_key' => 'your_google_api_key_here'],
            // - OpenWeatherMap.org API key for /weather command (see WeatherCommand.php)
            // 'weather' => ['owm_api_key' => 'your_owm_api_key_here'],
            // - Payment Provider Token for /payment command (see Payments/PaymentCommand.php)
//             'payment' => ['payment_provider_token' => 'your_payment_provider_token_here'],
        ],
    ],

    'admins' => env('TELEGRAM_ADMINS', ''),
    'paths'        => [
        'download' => __DIR__ . '/Download',
        'upload'   => __DIR__ . '/Upload',
    ],
    'limiter'      => [
        'enabled' => true,
    ],

];
