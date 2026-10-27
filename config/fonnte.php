<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Fonnte API Token
    |--------------------------------------------------------------------------
    | This token is used to authenticate with the Fonnte API.
    | You can get it from your Fonnte dashboard.
    */
    'token' => env('FONNTE_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Fallback Recipient
    |--------------------------------------------------------------------------
    | The default number used if no recipient is specified.
    */
    'fallback_recipient' => env('FALLBACK_FONNTE_RECIPIENT'),
];