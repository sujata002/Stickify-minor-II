<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/extension/save-note',         // this tells Laravel not to enforce CSRF on that route, which is required for Chrome extensions
        //for verifying token
        'api/verify-token',
        //for saving note
        'api/save-note',
    ];
}
