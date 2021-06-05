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
        '/api/upload/image',
        '/api/user/register',
        '/api/user/login',
        '/api/user/forgot_password',
        '/api/user/conversation/list',
        '/api/user/conversation/add',
        '/api/comments/list',
        '/api/comments/add',
        '/api/user/professionals/filter',
        '/api/evaluation/update',
        '/api/evaluation/get',
        '/api/comments/delete',
    ];
}
