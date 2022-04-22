<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DeleteUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        return Auth::user()->hasPermissionTo(User::DELETE_POST_PERMISSION) ? $next($request) : abort(404);
    }
}
