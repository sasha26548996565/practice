<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        return Auth::user()->hasRole(User::ADMIN_ROLE) ? $next($request) : abort(404);
    }
}
