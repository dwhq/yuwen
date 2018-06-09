<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN','your-mailgun-domain'),
        'secret' => env('MAILGUN_SECRET','your-mailgun-key'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET','your-sparkpost-key'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),         // Your GitHub Client ID
        'client_secret' => env('GITHUB_CLIENT_SECRET'), // Your GitHub Client Secret
        'redirect' => PHP_SAPI === 'cli' ? false : url(env('GITHUB_URL')),//回调地址
    ],
    'qq' => [
        'client_id' => env('QQ_CLIENT_ID'),         // Your GitHub Client ID
        'client_secret' => env('QQ_CLIENT_SECRET'), // Your GitHub Client Secret
        'redirect' => PHP_SAPI === 'cli' ? false : url(env('QQ_URL')),//回调地址
    ],
    'weibo' => [
        'client_id' => env('WEIBO_CLIENT_ID'),         // Your GitHub Client ID
        'client_secret' => env('WEIBO_CLIENT_SECRET'), // Your GitHub Client Secret
        'redirect' => PHP_SAPI === 'cli' ? false : url(env('WEIBO_URL')),//回调地址
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),         // Your GitHub Client ID
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'), // Your GitHub Client Secret
        'redirect' => env('FACEBOOK_URL'),//回调地址
    ],
];
