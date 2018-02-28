<?php

/**
 * This file is part of pedzed/laravel-uploadcare
 *
 * Copyright (c) Ped Zed <pedzed@outlook.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Public key
    |--------------------------------------------------------------------------
    |
    | This is the public key. You may use this in HTML and JavaScript.
    |
    */

    'public_key' => env('UPLOADCARE_PUBLIC_KEY', 'aeb2871347a8c70df675'),

    /*
    |--------------------------------------------------------------------------
    | Private key
    |--------------------------------------------------------------------------
    |
    | The secret between you and me.
    |
    */

    'private_key' => env('UPLOADCARE_PRIVATE_KEY', 'c71b4b337a0ef6424e94'),

];
