<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('api')->user()?->role_id == 1) {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki akses untuk melakukan aksi ini');
    }
}
