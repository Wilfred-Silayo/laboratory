<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthAndVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return Redirect::route('login')->with([
                'status' => 'Unauthorized! Please login', 'type' => 'error'
            ]);
        }

        if ($user && !$user->hasVerifiedEmail()) {
            return Redirect::route('verification.notice');
        }

        return $next($request);
    }
}
