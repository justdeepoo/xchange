<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
        * The URIs that should be excluded from CSRF verification.
        *
        * @var array
    */
    protected $except = [
        // 'buy',
        // 'sell',
        // 'open-orders',
        // 'cancel-trade',
        // 'trade',
        // 'buy-sell',
    //    'post-login',
    //    'post_forgot',
    //    'post-register',
    //    'withdraw',
    //    'secure/set_password',
    ];
}
