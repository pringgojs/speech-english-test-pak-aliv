<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // API
        'api/store',
        'camera',
        'manual-upload',
        'canvas',
        'group/temp-add-student',
        'front/store',
        'master/question/create-step-2'
    ];
}
